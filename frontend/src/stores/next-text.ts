import { nextTick, onMounted, onBeforeUnmount } from 'vue'

export default function useEventListener(element, event, handler) {
  let eventListener = null

  const setupEventListener = () => {
    nextTick(() => {
      const el = typeof element === 'string' ? document.querySelector(element) : element
      if (el) {
        el.addEventListener(event, handler)
        eventListener = { el, event, handler }
      }
    })
  }

  const removeEventListener = () => {
    if (eventListener) {
      eventListener.el.removeEventListener(eventListener.event, eventListener.handler)
      eventListener = null
    }
  }

  onMounted(setupEventListener)
  onBeforeUnmount(removeEventListener)

  return { setupEventListener, removeEventListener }
}