<template>
  <div>
      <loading :active.sync="isLoading"
        :is-full-page="false">
        </loading>
        <filter-bar></filter-bar>          
      <vuetable ref="vuetable"
        api-url="/admin/orders/get"
        :fields="order_fields"
        data-path="data"
        :css="css.table"
        pagination-path=""
        :append-params="moreParams"
        @vuetable:loading="pageLoading"
        @vuetable:loaded="pageLoaded"
        @vuetable:pagination-data="onPaginationData">
        <div slot="order-status" slot-scope="props">
          <span v-if="props.rowData.status == 1" class="label label-success">Active</span>
          <span v-if="props.rowData.status == 2" class="label label-danger">Cancelled</span>
          <span v-if="props.rowData.status == 3" class="label label-warning">Disputed</span>
          <span v-if="props.rowData.status == 4" class="label label-success">In progress</span>
          <span v-if="props.rowData.status == 5" class="label label-primary">Completed</span>
          <span v-if="props.rowData.status == 6" class="label label-primary">Closed</span>
          <span v-if="props.rowData.status == 7" class="label label-info">Refunded</span>
          <span v-if="props.rowData.status == 8" class="label label-info">Revision</span>          
        </div>        
        <div class="btn-group" role="group" slot="order-actions" slot-scope="props">
            <a :href="'/admin/orders/'+props.rowData.id" class="btn btn-primary btn-xs" >Details</a>
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
import moment from 'moment'
import FilterBar from '../addons/FilterBar'
import CssForBootstrap3 from '../bootstrapstyles.js'
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
  components: {
      Loading,
      'filter-bar':FilterBar
  },
  data () {
    return {      
      moreParams: {},
      isLoading: false,
      css: CssForBootstrap3,
      order_fields: [
        {
          name: 'id',
          title: 'Order#',
          sortField: 'id'
        },
        {
          name: 'subject',
          title: 'Subject',
          sortField: 'subject'
        },
        {
          name: 'numpages',
          title: 'Pages',
          sortField: 'numpages'
        },
        {
          name: 'budget',
          title: 'Budget',
          sortField: 'budget'
        },
        {
          name: 'created_at',
          formatter: function(created_at) {
              if (created_at === undefined || created_at === null) {
                  return 'no date'
              }else {
                  return moment(created_at).fromNow()
              }            
          },
          title: 'Created',
          sortField: 'created_at'
        },
        // {
        //   name: 'status',
        //   title: 'Status',
        //   sortField: 'status'
        // },
        {
          name: "order-status",
          title: 'Status',
        },
        {
          name: 'tutor.name',
          title: 'Awarded to',
          sortField: 'tutor.name'
        },
        {
          name: 'agreed_amount',
          title: 'Agreed amount',
          sortField: 'agreed_amount'
        },
        // {
        //   name: 'agreed_amount',
        //   title: 'Bids',
        //   sortField: 'agreed_amount'
        // },
        {
          name: "order-actions",
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
                'title': filterData.filterTitle,
                'subject': filterData.filterSubject,
                'awardedto': filterData.AwardedTo,
                'budget': filterData.filterBudget,
                'status': filterData.filterStatus,
                'createdat': filterData.fiterCreatedAt
            }
            Vue.nextTick( () => this.$refs.vuetable.refresh())
        },
        onFilterReset () {
            this.moreParams = {}
            Vue.nextTick( () => this.$refs.vuetable.refresh())
        },
        globevariable () {
            return 'Daniel'
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