<template>
     <li class="dropdown d-block" style="margin-top: 5px;margin-right: 80px">
         <a
            href="#"
            class="notification-wrapper-icon"
            id="notifications"
            data-toggle="dropdown"
            aria-haspopup="true">
            <i class="fas fa-bell fa-2x"></i>
        </a>
            <span class="badge bg-primary rounded-pill" v-if="unread > 0" >{{ unread }} </span>

        <div class="dropdown-menu lrg" aria-labelledby="notifications">
            <div class="dropdown-menu-header">
                <h5>Notifications</h5>
                <p class="m-0 sub-title" v-if="unread > 0">
                    You have {{ unread }} unread notifications
                </p>
                        <hr class="my-4">

            </div>
            <ul   @scroll="scroll()">
                <div v-if="currentNotifications.length > 0">
                    <li class="dropdown-item"
                        v-for="notification in currentNotifications"

                         :class="notification.read_at ? 'new-notification' : ''">
                             <a  :href="notification.data['route']" @click="markAsRead(notification.id)" class="clearfix">
                            <div class="avatar-img">
                                 <span
                                    v-if="notification.type == 'App\\Notifications\\NewTicket'"
                                    class="icon-notification-2 notify-icon text-danger"
                                ></span>
                                <span
                                    v-if="notification.type == 'App\\Notifications\\NewTicketComment'"
                                    class="icon-notification-2 notify-icon text-danger"
                                ></span>
                            </div>
                            <div class="details">
                                <h6>Notification</h6>
                                <p>{{ notification.data['message'] }}</p>
                                <small>{{ notification.created_at | formatTimestamp }}</small>
                            </div>
                        </a>
                    </li>
                </div>
                <div v-else>
                    <li class="no-notification-data">
            <span class="clearfix">
              <p>You don't have notifications yet</p>
            </span>
                    </li>
                </div>
                <div>
                    <a v-if="loading" class="dropdown-item text-center" href="#">
                        <div class="loader"></div>
                    </a>
                </div>
                <div class="show-all-notification">
                    <a href="/notifications" class="view-more">Show All Notifications</a>
                </div>
            </ul>
        </div>
    </li>
</template>

<script>
import moment from "moment";

export default {
    mounted() {
        let self = this;
        socket.on(
            "notarijat_database_private-App.Models.User." +
            self.user.id +
            ":Illuminate\\Notifications\\Events\\BroadcastNotificationCreated",
            function (data) {
                 let new_notification = {
                    id: data.id,
                    data: data,
                    created_at: new Date().toLocaleString()
                };
                 self.currentNotifications.unshift(new_notification);
                self.unread++;
                self.total++;
                let isShown = $("#notifications").hasClass("show");
                if (isShown) {
                    self.readClicked();
                }
            }
        );
    },
    props: [
        "unread_notifications_count",
        "notifications",
        "user",
        "total_notifications"
    ],
    data() {
        return {
            unread: this.unread_notifications_count,
            currentNotifications: this.notifications,
            loading: false,
            total: this.total_notifications
        };
    },
    methods: {

        readClicked() {
            let self = this;
            setTimeout(self.readNotifications, 1000);
        },
        markAsRead(id){
             if (this.unread > 0) {
                 let self = this
    axios.post("/notifications/mark/read", {
                    id: id,
            }).then(response => {
                    self.unread = self.unread - 1;
                });
             }
        },
        readNotifications() {
            if (this.unread > 0) {
                let self = this;

                axios.post("/notifications/read").then(response => {
                    self.unread = 0;
                    self.currentNotifications.forEach(function (value) {
                        value.read_at = 1;
                    });
                });
            }
        },
        scroll() {
            let container = this.$refs.notifications_scroll;
            if (
                container.scrollTop + container.offsetHeight ==
                container.scrollHeight &&
                this.currentNotifications.length < this.total
            ) {
                this.loading = true;
                this.loadMoreNotifications();
            }
        },
        loadMoreNotifications() {
            let self = this;
            axios
                .post("/notifications/load-more", {
                    loaded: self.currentNotifications.length
                })
                .then(response => {
                    response.data.notifications.forEach(function (value) {
                        self.currentNotifications.push(value);
                    });

                    self.total = response.data.total;
                    self.loading = false;
                });
        }
    },
    filters: {
        formatTimestamp(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY HH:mm");
            }
        }
    }
};
</script>
<style>
.scrollable {
    height: 385px;
    overflow-y: scroll;
}

.loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3f65d3;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
    margin-left: 50%;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
