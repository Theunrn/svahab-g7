import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin/dashboard',
      name: 'dashboard',
      component: () => import('../views/Admin/DashboardView.vue'),
      meta: {
        requiresAuth: true,
        role: 'admin'
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Web/HomeView.vue')
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/Web/AboutView.vue')
    },
    {
      path: '/fields',
      name: 'fields',
      component: () => import('../views/Web/FieldsView.vue')
    },
    {
      path: '/shop',
      name: 'shop',
      component: () => import('../views/Web/ShopView.vue')
    },
    {
      path: '/contact',
      name: 'contact',
      component: () => import('../views/Web/ContactView.vue')
    },
    {
      path: '/field/detail/:id',
      name: 'Detail',
      component: () => import('../views/Web/Field/FieldDetailView.vue')
    },
    {
      path: '/field/book/:id',
      name: 'Book',
      component: () => import('../views/Web/Field/FieldDetailView.vue')
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  const publicPages = ['/login']
  const authRequired = !publicPages.includes(to.path)
  const store = useAuthStore()

  try {
    const { data } = await axiosInstance.get('/me')

    store.isAuthenticated = true
    store.user = data.data

    store.permissions = data.data.permissions.map((item: any) => item.name)
    store.roles = data.data.roles.map((item: any) => item.name)

    const rules = () =>
      defineAclRules((setRule) => {
        store.permissions.forEach((permission: string) => {
          setRule(permission, () => true)
        })
      })

    simpleAcl.rules = rules()
  } catch (error) {
    /* empty */
  }

  if (authRequired && !store.isAuthenticated) {
    next('/login')
  } else {
    next()
  }
})

export default { router, simpleAcl }