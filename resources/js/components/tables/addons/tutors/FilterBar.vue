<template>
    <div class="col.md-12">
        <form class="form-inline col-md-9">
            <div class="form-group">
                <label for="search_filter_by"><strong>Search by</strong></label>
            </div>

            <div class="form-group">
                <select v-model="filterData.search_filter_by" name="search_filter_by" id="search_filter_by" class="form-control" required="required">
                    <option value="email">Email</option>
                    <option value="name">Username</option>
                    <option value="fullname">Full name</option>
                    <option value="verified">Status</option>
                </select>
            </div>

            <div v-if="filterData.search_filter_by == 'email'" id="sortByEmail" class="form-group">
                <input v-model="filterData.filterEmail"
                    name="filterEmail"
                    class="form-control"
                    @keyup.enter="doFilter"
                    placeholder="Enter email address">
            </div>

            <div v-if="filterData.search_filter_by == 'name'" id="sortByName" class="form-group">
                <input v-model="filterData.filterName"
                    name="filterName"
                    class="form-control"
                    @keyup.enter="doFilter"
                    placeholder="Enter username">
            </div>

            <div v-if="filterData.search_filter_by == 'fullname'" id="sortByFullName" class="form-group">
                <input v-model="filterData.filterFullname"
                    name="filterFullname"
                    class="form-control"
                    @keyup.enter="doFilter"
                    placeholder="Enter full name">
            </div>

            <div v-if="filterData.search_filter_by == 'verified'" id="sortByStatus" class="form-group">
                <select name="filterVerified" v-model="filterData.filterVerified" id="filterVerified" class="form-control">
                    <option value="verified">Verified</option>
                    <option value="notverified">Not Verified</option>
                </select>
            </div>         

            <div class="form-group">
                <button class="form-control btn btn-primary" @click.prevent="doFilter"><strong>Search</strong></button>
            </div>
            <div class="form-group">
                <button class="form-control btn btn-default" @click.prevent="resetFilter"><strong>Reset</strong></button>
            </div>            
        </form>
        <div class="col-md-3">
            <div class="form-inline form-group pull-right">
                <button class="btn btn-default" data-toggle="modal" data-target="#settingsModal">
                    <span class="glyphicon glyphicon-cog"></span> Settings
                </button>
            </div>
        </div>
    </div>    
</template>

  <script>
  export default {
    data () {
      return {
          filterData: {
            search_filter_by: 'email',
            filterEmail: '',
            filterName: '',
            filterFullname: '',
            filterVerified: 'verified'
          }        
      }
    },
    methods: {
        doFilter () {
            this.$events.fire('filter-set', this.filterData)
        },
        resetFilter () {
            this.filterData.filterEmail = ''
            this.filterData.filterName = ''
            this.filterData.filterFullname = ''
            this.filterData.filterVerified = 1
            this.filterData.search_filter_by = 'email'
            this.$events.fire('filter-reset')
        }
    }
  }
</script>