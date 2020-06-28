/* eslint-disable promise/param-names */

import moment from 'moment'
import {
  SET_STEP,
  SET_USER,
  EMAILADDRESS_REQUEST,
  DEADLINE_REQUEST,
  SUBJECT_REQUEST,
  NUMPAGES_REQUEST,
  TITLE_REQUEST,
  FORMAT_REQUEST,
  LEVEL_REQUEST,
  BUDGET_REQUEST,
  ORDERDETAILS_REQUEST,
  SETSPINNER_REQUEST,
  POSTHOMEWORK_REQUEST,
  SHOWLOGIN_REQUEST,
  SHOWREGISTER_REQUEST,
  CHECKAUTH_REQUEST,
  LOGINEMAILADDRESS_REQUEST,
  LOGINPASSWORD_REQUEST,
  POSTHOMEWORK_LOGIN_REQUEST,
  REGITERUSERNAME_REQUEST,
  REGISTERFULLNAME_REQUEST,
  REGISTERPASSWORD_REQUEST,
  REGISTERCONFIRMPASSWORD_REQUEST,
  POSTHOMEWORK_REGISTER_REQUEST,
  LOGINSPINNER_REQUEST,
  REGISTERSPINNER_REQUEST,
  AUTHERROR_REQUEST,
  ESTIMATEPRICING,
  SETESTIMATE_PRICE
} from '../actions/calculator'
const state = {
  step: 'one',
  user: null,
  autherror: null,
  spinning: false,
  loginspinning: false,
  registerspinning: false,
  showloginmodal: false,
  showregistermodal: false,
  calcvalues: {
    emailaddress: '',
    deadline: null,
    subject: 'Art',
    numpages: 1,
    title: '',
    format: 'APA',
    level: 'High school',
    budget: '',
    orderdetails: '',
    estimateprice: 0
  },
  login: {
    emailaddress: null,
    password: null
  },
  register: {
    username: '',
    fullname: '',
    password: '',
    password_confirmation: ''
  }
}

const getters = {
  GetUser: state => state.user,
  GetAuthError: state => state.autherror,
  showLogin: state => state.showloginmodal,
  showRegister: state => state.showregistermodal,
  GetLoginDetails: state => state.login,
  GetRegisterDetails: state => state.register,
  isLoggedin: state => state.user !== null,
  GetStep: state => state.step,
  GetSpinning: state => state.spinning,
  GetLoginSpinning: state => state.loginspinning,
  GetRegisterSpinning: state => state.registerspinning,
  GetCalculatorValues: state => state.calcvalues,
  getestimatePricing: state => parseInt(state.calcvalues.estimateprice, 10)
}

const actions = {
    [ESTIMATEPRICING]: ({ state, commit }) => {
        if (state.calcvalues.deadline) {
           let deadline = moment(state.calcvalues.deadline);
           let hours = parseInt(deadline.diff(moment(), 'hours'), 10)
           var baseprice = 5
           switch (true) {
               case (hours >= 24 && hours < 36):
                    var calculateddeadline = 2.22
                    break
                case (hours >= 36 && hours < 48):
                    var calculateddeadline = 1.9
                    break
                case (hours >= 48 && hours < 72):
                    var calculateddeadline = 1.67
                    break
                case (hours >= 72 && hours < 120):
                    var calculateddeadline = 1.56
                    break

                case (hours >= 120 && hours < 240):
                    var calculateddeadline = 1.45
                    break

                case (hours >= 240 ):
                    var calculateddeadline = 1
                    break
               default:
                    var calculateddeadline = 2.22
                    break
           }

           switch (state.calcvalues.level) {
               case 'High school':
                   var ac_level = 1
                   break
               case 'Undergraduate 1-2':
                    var ac_level = 1.4
                    break
                case 'Undergraduate 3-4':
                    var ac_level = 1.6
                    break
                case 'Masters':
                    var ac_level = 1.8
                    break
                case 'PHD':
                    var ac_level = 2.3
                    break
               default:
                   var ac_level = 2.3
                   break
           }
           let total = parseInt(baseprice * calculateddeadline * state.calcvalues.numpages * ac_level, 10)
           switch (true) {
               case (total >= 5 && total < 10):
                   var budget = '$5-$10'
                   break
               case (total >= 10 && total < 30):
                   var budget = '$10-$30'
                   break
               case (total >= 30 && total < 100):
                   var budget = '$30-$100'
                   break
               case (total >= 100 && total < 250):
                   var budget = '$100-$250'
                   break
               case (total >= 250 && total < 500):
                   var budget = '$250-$500'
                   break
                case (total >= 500 && total < 1000):
                    var budget = '$500-$1000'
                    break

                case (total >= 1000):
                    var budget = '$500-$1000'
                    break
               default:
                   var budget = '$5-$10'
                   break
           }
           //commit(BUDGET_REQUEST, budget)

           commit(SETESTIMATE_PRICE, total)
        }else{
            commit(SETESTIMATE_PRICE, 0)
        }
    },
  [POSTHOMEWORK_REQUEST]: ({ commit, dispatch, rootGetters }, payload) => {
    if (rootGetters.isLoggedin) {
      axios.post('/post-order', {
        orderdetails: payload
      })
      .then(result => {
        window.location = result.data.link
      })
      .catch()
    } else {
      //check if user exist in database via email address and request sign in
        dispatch(CHECKAUTH_REQUEST, payload.emailaddress).then(authstatus => {
          if (authstatus.data.action == 'login') {
            commit(SHOWLOGIN_REQUEST, true)
            commit(SETSPINNER_REQUEST, false)
          } else {
            commit(SHOWREGISTER_REQUEST, true)
            commit(SETSPINNER_REQUEST, false)
          }
        })
      //If does not exist sign up user and submit homework
      //console.log('User not logged in')
    }
  },
  [CHECKAUTH_REQUEST]: ({ state, commit, dispatch, rootGetters }, payload) => {
    return new Promise((resolve, reject) => {
      axios.post('/post-order/checkifexists', {
        emailaddress: payload
      })
      .then(result => {
        resolve(result)
        return result
      })
      .catch((err) => {
        reject(err)
      })
    })
  },
  [POSTHOMEWORK_LOGIN_REQUEST]: ({ commit, rootGetters }, payload) => {
    return new Promise((resolve, reject) => {
      commit(LOGINSPINNER_REQUEST, true)
      commit(AUTHERROR_REQUEST, null)
      axios.post('/post-order/login', {
          password: payload.password,
          orderdetails: rootGetters.GetCalculatorValues
        })
        .then(result => {
          resolve(result)
          window.location = result.data.link
        })
        .catch((err) => {
          let firsterrror = err.response.data.errors[Object.keys(err.response.data.errors)[0]][0]
          commit(LOGINSPINNER_REQUEST, false)
          commit(AUTHERROR_REQUEST, firsterrror)
          reject(err)
        })
    })
  },
  [POSTHOMEWORK_REGISTER_REQUEST]: ({ commit, rootGetters }, payload) => {
    return new Promise((resolve, reject) => {
      commit(REGISTERSPINNER_REQUEST, true)
      commit(AUTHERROR_REQUEST, null)
      axios.post('/post-order/register', {
          name: payload.username,
          email: rootGetters.GetCalculatorValues.emailaddress,
          fullname: payload.fullname,
          password: payload.password,
          password_confirmation: payload.password_confirmation,
          orderdetails: rootGetters.GetCalculatorValues
        })
        .then(result => {
          resolve(result)
          window.location = result.data.link
        })
        .catch((err) => {
          let firsterrror = err.response.data.errors[Object.keys(err.response.data.errors)[0]][0]
          commit(AUTHERROR_REQUEST, firsterrror)
          commit(REGISTERSPINNER_REQUEST, false)
          reject(err)
        })
    })
  },
}

const mutations = {
  [SETESTIMATE_PRICE]: (state, payload) => {
    state.calcvalues.estimateprice = payload
  },

  [SET_USER]: (state, payload) => {
      state.user = payload
  },

  [SET_STEP]: (state, payload) => {
    state.step = payload
  },
  [EMAILADDRESS_REQUEST]: (state, payload) => {
    state.calcvalues.emailaddress = payload
  },
  [DEADLINE_REQUEST]: (state, payload) => {
    state.calcvalues.deadline = payload
  },
  [SUBJECT_REQUEST]: (state, payload) => {
    state.calcvalues.subject = payload
  },
  [NUMPAGES_REQUEST]: (state, payload) => {
    if (payload == 'plus') {
      state.calcvalues.numpages++
    } else {
      if (state.calcvalues.numpages > 1) {
        state.calcvalues.numpages--
      }
    }
  },

  [TITLE_REQUEST]: (state, payload) => {
    state.calcvalues.title = payload
  },
  [LEVEL_REQUEST]: (state, payload) => {
    state.calcvalues.level = payload
  },
  [FORMAT_REQUEST]: (state, payload) => {
    state.calcvalues.format = payload
  },
  [BUDGET_REQUEST]: (state, payload) => {
    state.calcvalues.budget = payload
  },
  [ORDERDETAILS_REQUEST]: (state, payload) => {
    state.calcvalues.orderdetails = payload
  },
  [SETSPINNER_REQUEST]: (state, payload) => {
    state.spinning = payload
  },
  [SHOWLOGIN_REQUEST]: (state, payload) => {
    state.showloginmodal = payload
  },
  [SHOWREGISTER_REQUEST]: (state, payload) => {
    state.showregistermodal = payload
  },
  //Login mutator
  [LOGINEMAILADDRESS_REQUEST]: (state, payload) => {
    state.login.emailaddress = payload
  },
  [LOGINPASSWORD_REQUEST]: (state, payload) => {
    state.login.password = payload
  },
  [LOGINSPINNER_REQUEST]: (state, payload) => {
    state.loginspinning = payload
  },
  //Register mutator
  [REGITERUSERNAME_REQUEST]: (state, payload) => {
    state.register.username = payload
  },
  [REGISTERFULLNAME_REQUEST]: (state, payload) => {
    state.register.fullname = payload
  },
  [REGISTERPASSWORD_REQUEST]: (state, payload) => {
    state.register.password = payload
  },
  [REGISTERCONFIRMPASSWORD_REQUEST]: (state, payload) => {
    state.register.password_confirmation = payload
  },
  [REGISTERSPINNER_REQUEST]: (state, payload) => {
    state.registerspinning = payload
  },
  //Auth error
  [AUTHERROR_REQUEST]: (state, payload) => {
    state.autherror = payload
  }
}
export default {
  state,
  getters,
  actions,
  mutations,
}
