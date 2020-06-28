<template>
  <div>
      <loading :active.sync="isLoading"
        :is-full-page="false">
        </loading>
        <filter-bar></filter-bar>          
      <vuetable ref="vuetable"
        api-url="/admin/tutors/get"
        :fields="tutor_fields"
        data-path="data"
        :css="css.table"
        pagination-path=""
        :append-params="moreParams"
        @vuetable:loading="pageLoading"
        @vuetable:loaded="pageLoaded"
        @vuetable:pagination-data="onPaginationData">
        <div slot="tutor-name" slot-scope="props">
            <a :href="'/admin/tutors/scholar-profile/' + props.rowData.id"><strong>{{ props.rowData.name }}</strong></a>                 
        </div>
        <div slot="tutor-status" slot-scope="props">
          <img v-if="props.rowData.profile.verified === null" src="/img/cross.png" width="20" height="20" class="img-responsive" alt="No">
          <img src="/img/tick.png" width="20" height="20" class="img-responsive" alt="Yes" v-else>       
        </div>        
        <div class="btn-group" role="group" slot="tutor-actions" slot-scope="props">
            <a :href="'/admin/tutors/edit/'+props.rowData.id" type="button" class="btn btn-sm btn-success"><strong>Edit</strong></a>
            <a :href="'/admin/tutors/reset/'+props.rowData.id" onclick="return confirm('Are you sure you want to reset the tutors\' password? A new password will be generated and sent to the tutor\'s email');" type="button" class="btn btn-sm btn-default"><strong>Reset</strong></a>
            <a v-if="props.rowData.profile.verified == null" href="#" onclick="return confirm('You are about to mark this tutor as verified. After the tutor is verified, He/she will be able to place bids. Click on the tutors\' link to view their documents before verifying');" type="button" class="btn btn-sm btn-primary"><strong>Verify</strong></a>
            <a href="#" onclick="return confirm('Are you sure you want to unverify this tutor?');" type="button" class="btn btn-sm btn-info" v-else><strong>Unverify</strong></a>
            <a v-if="props.rowData.status != 1" href="#" onclick="return confirm('You are about to unsuspend this tutor. Are you sure?');" type="button" class="btn btn-sm btn-primary"><strong>Unsuspend</strong></a>
            <a href="#" onclick="return confirm('Are you sure you want to suspend this tutor?, tutor will not be able to log in again after log out');" type="button" class="btn btn-sm btn-warning" v-else><strong>Suspend</strong></a>
            <a href="#" @click.prevent="submitLoginAs(props.rowData.id)" type="button" class="btn btn-sm btn-primary"><strong>Login as</strong></a>
            <form :id="'login-as-'+ props.rowData.id" action="/loginas" method="POST" style="display: none;">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" :value="props.rowData.id" name="user_id">
            </form>
            <a :href="'/admin/tutors/scholar-payments/'+props.rowData.id" type="button" class="btn btn-sm btn-default"><strong>Payments</strong></a>
            <a :href="'/admin/tutors/destroy/'+props.rowData.id" onclick="return confirm('Are you sure you want to delete this tutor? This action is not reversible, consider unverifying the tutor instead');" type="button" class="btn btn-sm btn-danger"><strong>Delete</strong></a>
        </div>
      </vuetable>
      <vuetable-pagination-info @vuetable-pagination:change-page="onChangePage" ref="paginationInfoTop"></vuetable-pagination-info>
      <vuetable-pagination
        ref="pagination"
        :css="css.pagination"
        @vuetable-pagination:change-page="onChangePage">
      </vuetable-pagination>   
  </div>
</template>
<script>
import Vue from 'vue'
import FilterBar from '../addons/tutors/FilterBar'
import CssForBootstrap3 from '../bootstrapstyles.js'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
  components: {
      Loading,
      'filter-bar':FilterBar
  },
  data () {
    return {
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      moreParams: {},
      isLoading: false,
      css: CssForBootstrap3,
      tutor_fields: [
        {
            name: "tutor-name",
            title: 'Tutor',
        },
        {
          name: 'email',
          title: 'Email',
          sortField: 'email'
        },
        {
          name: "tutor-status",
          title: 'Verified'
        },        
        {
          name: "tutor-actions",
          title: 'Actions',
        }
      ]
    }
  },
  mounted(){
    this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
    this.$events.$on('filter-reset', e => this.onFilterReset())
  },
  computed:{},
    methods: {
        onPaginationData (paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
            this.$refs.paginationInfoTop.setPaginationData(paginationData)
        },
        onChangePage (page) {
            this.$refs.vuetable.changePage(page)
        },
        editRow(rowData){
            alert("You clicked edit on"+ JSON.stringify(rowData))
        },
        deleteRow(rowData){
            alert("You clicked delete on"+ JSON.stringify(rowData))
        },
        pageLoading(){    
            this.isLoading = true
        },
        pageLoaded(){      
            this.isLoading = false
        },
        onFilterSet (filterData) {
            this.moreParams = {
                'search_by': filterData.search_filter_by,
                'fullname': filterData.filterFullname,
                'name': filterData.filterName,
                'email': filterData.filterEmail,
                'verified': filterData.filterVerified
            }
            Vue.nextTick( () => this.$refs.vuetable.refresh())
        },
        onFilterReset () {
            this.moreParams = {}
            Vue.nextTick( () => this.$refs.vuetable.refresh())
        },
        globevariable () {
            return 'Daniel'
        },
        submitLoginAs(id){
            document.getElementById('login-as-'+ id).submit();            
        }
    }
}
</script>

<style>
.ui.right.floated.menu {
    float: right;
    margin: 0 0 0 .5rem;
}
.ui.floated.menu {
    float: left;
    margin: 0 .5rem 0 0;
}
.ui.pagination.menu {
    margin: 0;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    vertical-align: middle;
}
.ui.menu:last-child {
    margin-bottom: 0;
}
.ui.menu {
    font-size: 1.3rem;
}
.ui.menu {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin: 1rem 0;
    font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;
    background: #FFF;
    font-weight: 400;
    border: 1px solid rgba(34, 36, 38, 0.4);
    box-shadow: 0 1px 2px 0 rgba(34,36,38,.15);
    border-radius: .28571429rem;
    min-height: 2.85714286em;
}
.ui.pagination.menu .item {
    min-width: 3em;
    text-align: center;
}
.ui.menu > .item:first-child {
    border-radius: .28571429rem 0 0 .28571429rem;
}
.ui.menu:not(.vertical) .item {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.ui.menu .item {
    cursor: pointer;
    position: relative;
    vertical-align: middle;
    line-height: 1;
    text-decoration: none;
    -webkit-tap-highlight-color: transparent;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background: 0 0;
    padding: .92857143em 1.14285714em;
    text-transform: none;
    color: rgba(0,0,0,.87);
    font-weight: 400;
    -webkit-transition: background .1s ease,box-shadow .1s ease,color .1s ease;
    transition: background .1s ease,box-shadow .1s ease,color .1s ease;
}

.ui.menu .item::before {
    position: absolute;
    content: '';
    top: 0;
    right: 0;
    height: 100%;
    width: 1px;
    background: rgba(34, 36, 38, 0.4);
}

.ui.pagination.menu .icon.item i.icon {
    vertical-align: top;
}
.ui.menu .icon.item > .icon {
    width: auto;
    margin: 0 auto;
}

.ui.pagination.menu .active.item {
    border-top: none;
    padding-top: .92857143em;
    font-weight: bold;
    background-color: rgba(16, 16, 15, 0.79);
    color: rgb(255, 255, 255);
    box-shadow: none;
}

.ui.menu .item:hover {
    border-top: none;
    padding-top: .92857143em;
    background-color: rgba(24, 40, 160, 0.23);
    color: rgba(0,0,0,.95);
    box-shadow: none;
}

.ui.menu .item > i.icon {
    opacity: .9;
    float: none;
    margin: 0 .35714286em 0 0;
}
.ui.menu .item.disabled, .ui.menu .item.disabled:hover {
    cursor: default;
    background-color: transparent !important;
    color: rgba(40,40,40,.3);
}
</style>