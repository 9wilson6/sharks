<template>
    <div :class="{ 'disabled_orderform': alloworder == false }">
        <div class="place_order_title">
            <p>Place New Order</p><span>It's free, fast and secure!</span>
        </div>
        <ValidationObserver name="placeOrderForm" method="post" :action="formaction"  id="placeOrderForm" ref="orderform" tag="form" v-slot="{ invalid }" @submit.prevent="submitOrder()" class="place_order_form">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="writers" :value="JSON.stringify(writers)">
            <div class="field_item">
                <label for="email">Email:</label>
                <ValidationProvider name="Email address" rules="email|required" v-slot="{ errors, classes }">
                    <input :disabled="loggedin" name="email" v-model="email" placeholder="Email address" class="input" :class="{ 'errorinput': classes.invalid }">
                    <span class="vali_error">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>

            <div class="field_item">
                <label for="title">Title:</label>
                <ValidationProvider name="Title" rules="required" v-slot="{ errors, classes }">
                    <input name="title" v-model="title" placeholder="Title" class="input" :class="{ 'errorinput': classes.invalid }">
                    <span class="vali_error">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>

            <div class="field_item">
                <label for="subject">Subject:</label>
                <select name="subject" class="input selectinput" id="subject">
                    <option v-for="(sub, index) in subjectlist" :key="index" :value="sub">{{ sub }}</option>
                </select>            
            </div>

            <div class="field_item">
                <label for="budget">Budget:</label>
                <select name="budget" class="input selectinput" id="budget">
                    <option v-for="(bud, index) in budgetlist" :key="index" :value="bud.id">{{ bud.lable }}</option>
                </select>
            </div>
            <div v-if="writers.length != 0" class="field_item">
                <label>Writer(s):</label>
                <div class="field_files">
                    <div v-for="(writer, index) in writers" :key="index" class="field_files_item">
                        <a @click.prevent="removeTutor(writer.id)" href="#" class="file_icon"></a>
                        <a class="file_name">{{ writer.name }}</a>
                    </div>
                </div>
            </div>

            <div class="field_item">
                <button :disabled="invalid || submitdisabled" :class="{ 'button big yellow': true, 'disabledbtn': invalid || submitdisabled }" type="submit">
                    <span :class="{ 'loginloading': submitdisabled }"></span> Continue
                </button>
            </div>
        </ValidationObserver>
    </div>
</template>
<script>
import Vue from 'vue'
import { mapGetters } from 'vuex'
import { SET_COOKIES_WRITERS } from "../../store/actions/writers"
export default {
    data(){
        return {
            email: '',
            title: '',
            subject: 'UK Essay',
            budget: '$5-$10',
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
            loggedin: false,
            alloworder: true,
            formaction: '/projects/save',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            submitdisabled: false
        }
    },
    computed: {
        ...mapGetters({
            writers: 'getCookieWriters'
        })
    },
    filters: {
        datFormat: function(dat){
            return moment(dat).format('LLLL');
        }
    },
    mounted() {
        //check if the user is logged in
        this.checkifloggedin().then((resp) => {
            this.alloworder = resp.allow
            if (resp.status) {
                this.loggedin = true
                this.email = resp.user.email
            }
        })

        let tutors = Cookies.getJSON("snwriters")
        if (tutors == undefined) {
            this.$store.commit(SET_COOKIES_WRITERS, [])
            return
        }

        this.$store.commit(SET_COOKIES_WRITERS, tutors)
        
        //this.writers =  tutors
    },

    methods: {
        async submitOrder() {
            this.submitdisabled = true
            const isValid = await this.$refs.orderform.validate()
            if (isValid) {
                if (!this.loggedin) {
                    this.checkifemailexists().then((resp) => {
                        if (resp.status) {                            
                            $('#completeOrderLoginEmail').val(this.email);                            
                            $("#loginPopUpStudyBay").show();
                            this.submitdisabled = false
                            Cookies.remove('snwriters');
                            return
                        } else{
                            this.submitdisabled = false
                            Cookies.remove('snwriters');
                            $('#placeOrderForm').submit();
                        }
                    })
                }else{
                    $('#placeOrderForm').submit();
                }
            }
        },
        removeTutor(tutorId){
            //Remove writer from cookie
            var tutors = Cookies.getJSON("snwriters")
            if (tutors == undefined) {
                this.$store.commit(SET_COOKIES_WRITERS, [])
                return
            }
            //Remove cookie
            Cookies.remove('snwriters');
            tutors = tutors.filter(function( obj ) {
                return obj.id !== tutorId
            });
            Cookies.set("snwriters", tutors)
            //Remove writer from cookie
            this.$store.commit(SET_COOKIES_WRITERS, Cookies.getJSON('snwriters'))
            //this.writers = Cookies.getJSON('snwriters');
        },

        async checkifloggedin() {
            try {
                let response = await axios.get('/projects/islogged/in');       
                return response.data
            } catch(error) {
                // error
            }
        },
        async checkifemailexists() {
            try {
                let response = await axios.post('/projects/isuser/registered', {
                    email: this.email,
                    title: this.title,
                    subject: this.subject,
                    budget: this.budget,
                    writers: JSON.stringify(this.writers)
                });
                return response.data
            } catch(error) {
                // error
            }
        }
    } 
}
</script>
<style>

.vali_error {
    float: right;
    color: #e72828;
    font-size: 14px;
}

.errorinput {
    border: #e72828 1px solid;
}


.disabledbtn {
    opacity:0.5;
    cursor:not-allowed !important;
}

.disabled_orderform {
    pointer-events: none;
    opacity: 0.4;
}


.loginloading {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255,255,255,.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 1s ease-in-out infinite;
    -webkit-animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}


@media screen and (max-width: 680px) {
    .place_order .selectinput {
        float: left;
        width: 200px;
    }
}

</style>