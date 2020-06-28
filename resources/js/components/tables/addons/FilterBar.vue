<template>
    <div class="col.md-12">
        <form class="form-inline col-md-9">
            <div class="form-group">
                <label for="search_filter_by"><strong>Search by</strong></label>
            </div>

            <div class="form-group">
                <select v-model="filterData.search_filter_by" name="search_filter_by" id="search_filter_by" class="form-control" required="required">
                    <option value="title">Title</option>
                    <option value="subject">Subject</option>
                    <option value="budget">Budget</option>
                    <option value="awardedto">Awarded to </option>
                    <option value="status">Status</option>
                    <option value="createdat">Created at</option>
                </select>
            </div>

            <div v-if="filterData.search_filter_by == 'title'" id="sortByTitle" class="form-group">
                <input v-model="filterData.filterTitle"
                    name="filterTitle"
                    class="form-control"
                    @keyup.enter="doFilter"
                    placeholder="Start typing the title">
            </div>

            <div v-if="filterData.search_filter_by == 'budget'" id="sortByBudget" class="form-group">
                <select v-model="filterData.filterBudget" name="filterBudget" id="filterBudget" class="form-control">
                    <option v-for="(budget, index) in filterData.budgetlist" :key="index" :value="budget.id">{{ budget.lable }}</option>
                </select>
            </div>

            <div v-if="filterData.search_filter_by == 'subject'" id="sortBySubject" class="form-group">
                <select v-model="filterData.filterSubject" name="filterSubject" id="filterSubject" class="form-control">
                    <option v-for="(subject, index) in filterData.subjectlist" :key="index" :value="subject">{{ subject }}</option>
                </select>
            </div>

            <div v-if="filterData.search_filter_by == 'awardedto'" id="sortByAwardedTo" class="form-group">
                <input v-model="filterData.AwardedTo"
                    name="AwardedTo"
                    class="form-control"
                    @keyup.enter="doFilter"
                    placeholder="Start typing tutor username">
            </div>

            <div v-if="filterData.search_filter_by == 'status'" id="sortByStatus" class="form-group">
                <select name="filterStatus" v-model="filterData.filterStatus" id="filterStatus" class="form-control">
                    <option value="1">Active</option>
                    <option value="2">Cancelled</option>
                    <option value="3">Disputed</option>
                    <option value="4">In progress</option>
                    <option value="5">Completed</option>
                    <option value="6">Closed</option>
                    <option value="7">Refunded</option>
                    <option value="8">Revision</option>
                </select>
            </div>

            <div v-if="filterData.search_filter_by == 'createdat'" id="sortByCreatedAt" class="form-group">
                <datetime 
                    v-model="filterData.fiterCreatedAt"
                    name="fiterCreatedAt"
                    input-class="form-control"
                    @keyup.enter="doFilter"
                    placeholder="Created date">
                </datetime>
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
    import { Datetime } from 'vue-datetime';
    import 'vue-datetime/dist/vue-datetime.css'
  import moment from 'moment'
  export default {
    data () {
      return {
          filterData: {
            search_filter_by: 'title',
            filterTitle: '',
            filterSubject: 'Art',
            AwardedTo: '',
            filterStatus: 1,
            filterBudget: '$5-$10',
            fiterCreatedAt: '',
            subjectlist: [
                'Art',
                'Business',
                'English',
                'Computer',
                'Foregn Language',
                'History',
                'Law',
                'Mathematics',
                'Medicine',
                'Philosophy',
                'Science',
                'General'
            ],
            budgetlist: [
                {
                    id: '$5-$10',
                    lable: 'Mini Project ($5-10 USD)'
                },
                {
                    id: '$10-$30',
                    lable: 'Micro Project ($10-30 USD)'
                },
                {
                    id: '$30-$100',
                    lable: 'Standard Project ($30-100 USD)'
                },
                {
                    id: '$100-$250',
                    lable: 'Medium Project ($100-250 USD)'
                },
                {
                    id: '$250-$500',
                    lable: 'Large Project ($250-500 USD)'
                },
                {
                    id: '$500-$1000',
                    lable: 'Major Project ($500-1000 USD)'
                }
            ],
          }        
      }
    },
    components: {
        datetime: Datetime
    },
    methods: {
        doFilter () {
            this.$events.fire('filter-set', this.filterData)
        },
        resetFilter () {
            this.filterData.filterTitle = ''
            this.filterData.filterSubject = 'Art'
            this.filterData.AwardedTo = ''
            this.filterData.filterStatus = ''
            this.filterData.filterBudget = '$5-$10'
            this.filterData.fiterCreatedAt = ''
            this.filterData.search_filter_by = 'title'
            this.$events.fire('filter-reset')
        }
    }
  }
</script>