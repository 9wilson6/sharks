<template>
    <div v-show="autherror" class="alert alert-danger">
            <strong>{{ autherror }}</strong>
        </div>
        <form @submit.prevent="SignIn()">
            <a-spin :spinning="spinning" tip="Logging you in..." size="large">
                <div :class="{'form-group': true, 'has-error': errors.has('emailaddress')}">
                    <label for="emailaddress">Email address:</label>
                    <a-input data-vv-validate-on="none" v-validate="'required'" data-vv-as="email address" name="emailaddress"
                        placeholder="Email address" disabled="disabled" type="email" class="form-control" v-model="emailaddress" ref="emailInput">
                        <a-icon slot="prefix" type="user" />
                    </a-input>
                    <span v-show="errors.has('emailaddress')" class="help-block"><strong>{{
                            errors.first('emailaddress') }}</strong></span>
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

                <div class="form-group remember-forgot">
                    <div class="col-md-6 col-sm-6">
                        <a-checkbox @change="onChange">Remember</a-checkbox>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <a href="/password/reset" class="pull-right"><strong>Forgot Password</strong></a>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary"><strong>Post Homework</strong></button>
                </div>
            </a-spin>
        </form>
</template>