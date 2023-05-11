require('./bootstrap');
import axios from 'axios'
import Vue from 'vue'

import BootstrapVue from 'bootstrap-vue'

window._token = document.head.querySelector('meta[name="csrf-token"]').content


import App from './MainApp'
import VueRouter from 'vue-router'
import Container from './Container'
import DriverList from './components/DriverList.vue'
import DriverForm from './components/DriverForm.vue'
import VehicleList from './components/VehicleList.vue'
import VehicleForm from './components/VehicleForm.vue'
import TripList from './components/TripList.vue'
import TripForm from './components/TripForm.vue'
import { ValidationObserver, ValidationProvider } from 'vee-validate'
import './vendor/vee-validate'

Vue.use(BootstrapVue)
Vue.use(VueRouter)

Vue.component("ValidationProvider", ValidationProvider)
Vue.component("ValidationObserver", ValidationObserver)

export const createApp = () => {
  Vue.prototype.$app = window.settings
  Vue.prototype.$http = axios
  Vue.prototype.$app.route = window.route

  /**
   * Object to FormData converter
   */
  let objectToFormData = (obj, form, namespace) => {
    let fd = form || new FormData()

    for (let property in obj) {
      if (!obj.hasOwnProperty(property)) {
        continue
      }

      let formKey = namespace ? `${namespace}[${property}]` : property

      if (obj[property] === null) {
        fd.append(formKey, '')
        continue
      }
      if (typeof obj[property] === 'boolean') {
        fd.append(formKey, obj[property] ? '1' : '0')
        continue
      }
      if (obj[property] instanceof Date) {
        fd.append(formKey, obj[property].toISOString())
        continue
      }
      if (
        typeof obj[property] === 'object' &&
        !(obj[property] instanceof File)
      ) {
        objectToFormData(obj[property], fd, formKey)
        continue
      }
      fd.append(formKey, obj[property])
    }

    return fd
  }

  Vue.prototype.$app.objectToFormData = objectToFormData

  const routes = [
    {
      path: '/',
      component: Container,
      children: [
        {
          path: '/',
          name: 'trip-list',
          component: TripList,
        },
        {
          path: '/trip/add',
          name: 'trip-add',
          component: TripForm,
        },
        {
          path: '/trip/:id/update',
          name: 'trip-update',
          props: true,
          component: TripForm,
        },
        {
          path: '/trip/:id/detail',
          name: 'trip-detail',
          props: true,
          component: TripForm,
        },
        {
          path: '/driver',
          name: 'driver-list',
          component: DriverList,
        },
        {
          path: '/driver/add',
          name: 'driver-add',
          component: DriverForm,
        },
        {
          path: '/driver/:id/update',
          name: 'driver-update',
          props: true,
          component: DriverForm,
        },
        {
          path: '/driver/:id/detail',
          name: 'driver-detail',
          props: true,
          component: DriverForm,
        },
        {
          path: '/vehicle',
          name: 'vehicle-list',
          component: VehicleList,
        },
        {
          path: '/vehicle/add',
          name: 'vehicle-add',
          component: VehicleForm,
        },
        {
          path: '/vehicle/:id/update',
          name: 'vehicle-update',
          props: true,
          component: VehicleForm,
        },
        {
          path: '/vehicle/:id/detail',
          name: 'vehicle-detail',
          props: true,
          component: VehicleForm,
        },
      ],
    },
  ]

  const router = new VueRouter({
    mode: 'history',
    base: '',
    scrollBehavior: () => ({ y: 0, x: 0 }),
    routes
  })

  const app = new Vue({
    router,
    render: h => h(App)
  })

  return {
    app,
    router
  }
}

if (document.getElementById('app')) {
  const { app } = createApp()
  app.$mount('#app')
}
