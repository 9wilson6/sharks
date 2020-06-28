<template>
    <div>
        <div v-show="autherror" class="alert alert-danger">
            <strong>{{ autherror }}</strong>
        </div>
        <form @submit.prevent="RegisterNow()">
            <a-spin :spinning="spinning" tip="Registering you..." size="large">
                <div :class="{'form-group': true, 'has-error': errors.has('username')}">
                    <label for="username">Username <small class="text-info">(Username will be visible)</small>:</label>
                    <a-input data-vv-validate-on="none" v-validate="'required|alpha_num'" data-vv-as="username" name="username"
                        placeholder="Choose a username" type="text" class="form-control" v-model="username" ref="UserNameInput">
                        <a-icon slot="prefix" type="user" />
                        <a-icon v-if="username" slot="suffix" type="close-circle" @click="emitEmptyUserName" />
                    </a-input>
                    <span v-show="errors.has('username')" class="help-block"><strong>{{ errors.first('username') }}</strong></span>
                </div>
                <div :class="{'form-group': true, 'has-error': errors.has('fullname')}">
                    <label for="fullname">Full name:</label>
                    <a-input data-vv-validate-on="none" v-validate="'required|alpha_spaces'" data-vv-as="full name" name="fullname"
                        placeholder="Full name" type="text" class="form-control" v-model="fullname" ref="FullNameInput">
                        <a-icon slot="prefix" type="user" />
                        <a-icon v-if="fullname" slot="suffix" type="close-circle" @click="emitEmptyFullName" />
                    </a-input>
                    <span v-show="errors.has('fullname')" class="help-block"><strong>{{ errors.first('fullname') }}</strong></span>
                </div>
                <div :class="{'form-group': true, 'has-error': errors.has('password')}">
                    <label for="password">Password:</label>
                    <a-input data-vv-validate-on="none" v-validate="'required'" data-vv-as="password" name="password"
                        placeholder="Password" type="password" class="form-control" v-model="password" ref="passwordInput">
                        <a-icon slot="prefix" type="lock" />
                        <a-icon v-if="password" slot="suffix" type="close-circle" @click="emitEmptyPassword" />
                    </a-input>
                    <span v-show="errors.has('password')" class="help-block"><strong>{{ errors.first('password') }}</strong></span>
                </div>
                <div :class="{'form-group': true, 'has-error': errors.has('password_confirmation')}">
                    <label for="password_confirmation">Confirm Password:</label>
                    <a-input data-vv-validate-on="none" v-validate="'required|confirmed:passwordInput'" data-vv-as="confirm password" name="password_confirmation" placeholder="Confirm Password" type="password" class="form-control" v-model="password_confirmation" ref="ConfirmpasswordInput">
                        <a-icon slot="prefix" type="lock" />
                        <a-icon v-if="password_confirmation" slot="suffix" type="close-circle" @click="emitEmptyConfirmPassword" />
                    </a-input>
                    <span v-show="errors.has('password_confirmation')" class="help-block"><strong>{{ errors.first('password_confirmation') }}</strong></span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary"><strong>Post Homework</strong></button>
                </div>
            </a-spin>
        </form>
    </div>
</template>

<script>
    import {
        mapGetters
    } from 'vuex'
    import {
        REGITERUSERNAME_REQUEST,
        REGISTERFULLNAME_REQUEST,
        REGISTERPASSWORD_REQUEST,
        REGISTERCONFIRMPASSWORD_REQUEST,
        POSTHOMEWORK_REGISTER_REQUEST
    } from '../../../../store/actions/calculator'
    export default {
        inject: ['$validator'],
        computed: {
            ...mapGetters({
                registerdetails: 'GetRegisterDetails',
                spinning: 'GetRegisterSpinning',
                autherror: 'GetAuthError'
            }),
            username: {
                get() {
                    return this.registerdetails.username
                },
                set(value) {
                    this.$store.commit(REGITERUSERNAME_REQUEST, value)
                }
            },
            fullname: {
                get() {
                    return this.registerdetails.fullname
                },
                set(value) {
                    this.$store.commit(REGISTERFULLNAME_REQUEST, value)
                }
            },
            password: {
                get() {
                    return this.registerdetails.password
                },
                set(value) {
                    this.$store.commit(REGISTERPASSWORD_REQUEST, value)
                }
            },
            password_confirmation: {
                get() {
                    return this.registerdetails.password_confirmation
                },
                set(value) {
                    this.$store.commit(REGISTERCONFIRMPASSWORD_REQUEST, value)
                }
            }
        },
        methods: {
            emitEmptyUserName() {
                this.$refs.UserNameInput.focus()
                this.username = ''
            },
            emitEmptyFullName() {
                this.$refs.FullNameInput.focus()
                this.fullname = ''
            },
            emitEmptyPassword() {
                this.$refs.passwordInput.focus()
                this.password = ''
            },
            emitEmptyConfirmPassword() {
                this.$refs.ConfirmpasswordInput.focus()
                this.password_confirmation = ''
            },
            RegisterNow() {
                this.$validator.validateAll({
                    'username': this.registerdetails.username,
                    'fullname': this.registerdetails.fullname,
                    'password': this.registerdetails.password,
                    'password_confirmation': this.registerdetails.password_confirmation
                }).then((result) => {
                    if (result) {
                        this.$store.dispatch(POSTHOMEWORK_REGISTER_REQUEST, this.registerdetails)
                    }
                })
            }
        },
    }
</script>

<style scoped>
    .remember-forgot {
        padding-bottom: 20px;
    }

    .components-input-demo-presuffix .anticon-close-circle {
        cursor: pointer;
        color: #ccc;
        transition: color 0.3s;
        font-size: 12px;
    }

    .components-input-demo-presuffix .anticon-close-circle:hover {
        color: #999;
    }

    .components-input-demo-presuffix .anticon-close-circle:active {
        color: #666;
    }
</style>