<template>
    <div>
        <div class="page-title large-page-title">
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <h5 class="title">Notifications</h5>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="daterange-container">
                        <div class="date-range">
                            <div class="search-container">
                                <div class="search-box">
                                    <input type="text" class="search-query" @keyup="startTimer()" v-model="search" placeholder="Search ...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="content-wrapper large-wrapper">
            <div id="content-page">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card custom-default">
                            <div class="card-header">
                                <div class="card-title">List of all notifications</div>
                            </div>
                            <div class="card-body py-2 px-0">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-data">
                                        <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody v-if="activeValues.length > 0">
                                            <tr  :key="index" v-for="(value, index) in activeValues">
                                                <a  :href="value.data['route']" class="clearfix">
                                                <td   >{{ value.data.message }}

                                                </td>
                                                </a>
                                                <td>{{ value.created_at | formatTimestamp }}</td>
                                            </tr>

                                        </tbody>
                                        <tbody v-else>
                                            <tr class="odd"><td colspan="4" class="dataTables_empty">No Data found</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <nav>
                                            <ul class="pagination justify-content-center success">
                                                <li :class="`page-item ${pageNumber === 0 ? 'disabled' : ''}`" @click="previousPage()">
                                                    <button type="button" class="page-link" :disabled="pageNumber === 0">Previous</button>
                                                </li>
                                                <li :class="`page-item ${pageNumber >= pageCount -1 ? 'disabled' : ''}`"  @click="nextPage()">
                                                    <button type="button" class="page-link" :disabled="pageNumber >= pageCount -1">Next</button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</template>
<script>
     import moment from 'moment';
    export default {
        props: ['values','count'],
        data() {
            return {
                activeValues: this.values,
                search: '',
                pageNumber: 0,
                pageCount: this.count,
                typingTimer: 0,
                loading: false
            }
        },
        mounted() {
        },

        methods: {

            nextPage() {
                this.pageNumber++;
                this.pagination();
            },
            previousPage() {
                this.pageNumber--;
                this.pagination();
            },
            pagination(){
                let self = this;
                let url = '/notifications/table';
                self.loading = true;
                axios.post(url, { page: self.pageNumber, search: self.search}
                ).then(response => {
                    self.loading = false;
                    self.activeValues = response.data.values;
                    self.pageCount = response.data.count;
                }).catch(error => {
                    self.loading = false;
                });
            },
            startTimer(){
                let self = this;
                clearTimeout(self.typingTimer);
                self.typingTimer = setTimeout(self.searchValues, 1000);
            },
            searchValues(){
                let self = this;
                let url = '/notifications/table';
                self.loading = true;
                axios.post(url, { page: self.pageNumber, search: self.search}
                ).then(response => {
                    self.loading = false;
                    self.activeValues = response.data.values;
                    self.pageNumber = 0;
                    self.pageCount = response.data.count;
                }).catch(error => {
                    self.loading = false;
                });
            },
        },
        filters: {
            formatTimestamp(value) {
                return moment(String(value)).format('DD.MM.YYYY HH:mm')
            }
        }
    }
</script>
