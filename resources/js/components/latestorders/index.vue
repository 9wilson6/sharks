<template>
    <div>
        <div class="pagination_container" style="padding-top: 10px;">
            <div v-for="(review, index) in reviews" :key="index" class="order_item pagination_item">
                <div class="order_item_title">
                    <div class="order_item_names">
                        <p>{{ review.order.subject }}</p><span>{{ review.order.format }}, {{ review.order.level }}, {{ review.order.numpages }} page(s)</span>
                    </div>
                    <div class="order_item_info">
                        <p>{{ review.order.date_completed }}</p><span>#{{ review.order.id }}, <span class="status">Completed</span></span>
                    </div>
                </div>
                <div class="order_block">
                    <div class="order_block_info">
                        <div class="order_block_user">
                            <div class="photo">
                                <a href="#">
                                    <img :src="review.order.tutor.avatar == null ? '/img/noprofile.png' : review.order.tutor.avatar" alt="Preview face image">
                                </a>
                            </div>

                            <div class="order_block_user_info">
                                <p><a href="#">{{ review.order.tutor.fullname }}</a></p>
                                <div class="order_block_user_awards">
                                    <div class="rating_block">
                                        <div class="rating" :data-score="review.averagereview" :title="review.averagereview">
                                            <img alt="1" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="2" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="3" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="4" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="5" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="6" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="7" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="8" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="9" src="/img/star_on_large.png" :title="review.averagereview">
                                            <img alt="10" src="/img/star_off_large.png" :title="review.averagereview">
                                        </div>
                                    </div>
                                    <div class="trophy">
                                        <img src="/img/trophy.png" alt="Trophy">
                                    </div>
                                </div>
                                <span><b></b>{{ review.completedorders }} completed order(s)</span>
                            </div>

                        </div>
                        
                        <a @click.prevent="requestThisUser(review.order.tutor)" class="button small green arrow">Request this writer</a>

                    </div>

                    <div class="order_feedbacks">
                        <span>Student's feedback:</span>
                        <div class="order_feedbacks_block">
                            <div class="order_feedback_item">
                                <p>{{ review.comments }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="show_more"><a class="button big blue pagination_more" href="#">Show more orders</a></div> -->
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { SET_COOKIES_WRITERS } from "../../store/actions/writers"
export default {
    data(){
        return {
            reviews: []
        }
    },
    computed: {
        ...mapGetters({
            writers: 'getCookieWriters'
        })
    },
    mounted(){
        this.getreviews().then((resp) => {           
            this.reviews = resp.reviews          
        })
    },
    filters:{

    },
    methods: {
        async getreviews() {
            try {
                let response = await axios.get('/reviews/get/latest');
                return response.data
            } catch(error) {
                // error
            }
        },

        requestThisUser(user){
            let writersarray = Cookies.getJSON("snwriters")
            if (writersarray == undefined) {
                this.$store.commit(SET_COOKIES_WRITERS, [])
                writersarray = []
            }            

            let useritem = {
                id: user.id,
                name: user.fullname
            }

            if (writersarray.some(e => e.id === useritem.id)) {                
                return
            } else {
                //Remove cookie
                Cookies.remove('snwriters');
                writersarray.push(useritem)
                Cookies.set("snwriters", writersarray)
                this.$store.commit(SET_COOKIES_WRITERS, writersarray)
                return
            }            
        }
    }
}
</script>
