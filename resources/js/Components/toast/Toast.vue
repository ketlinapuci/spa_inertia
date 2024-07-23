<template>
  <transition :name="transitionName">
    <div class="toast" :class="toastClasses" v-show="show">
      <div class="toast-icon flex justify-center items-center">
        <component :is="toastIcon"></component>
      </div>
      <div class="toast-content">
        <div class="toast-title">{{ toastTitle }}</div>
        <div class="toast-message">{{ message }}</div>
      </div>
      <button class="toast-button" @click="$emit('hide')">&times;</button>
    </div>
  </transition>
</template>

<script>
import IconError from "./IconError.vue";
import IconWarning from "./IconWarning.vue";
import IconSuccess from "./IconSuccess.vue";
export default {
  emits: ["hide"],
  data: () => ({
    timeout: null,
  }),
  watch: {
    show() {
      if (this.timeout) {
        clearTimeout(this.timeout);
      }
      this.timeout = setTimeout(() => {
        this.$emit("hide");
      }, 3000);
    },
  },
  props: {
    message: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      default: null,
    },
    show: {
      type: Boolean,
      default: false,
    },
    type: {
      type: String,
      default: "success",
      validator: function (value) {
        return ["success", "warning", "error"].indexOf(value) !== -1;
      },
    },
    position: {
      type: String,
      default: "bottom-right",
    },
  },
  computed: {
    transitionName() {
      const transitions = {
        "top-left": "ltr",
        "bottom-left": "ltr",
        "top-right": "rtl",
        "bottom-right": "rtl",
      };
      return transitions[this.getPosition];
    },
    toastType() {
      return `toast-${this.getType}`;
    },
    toastIcon() {
      return `icon-${this.getType}`;
    },
    getType() {
      return ["success", "warning", "error"].indexOf(this.type) === -1
        ? "success"
        : this.type;
    },
    getPosition() {
      return ["bottom-left", "bottom-right", "top-left", "top-right"].indexOf(
        this.position
      ) === -1
        ? "bottom-right"
        : this.position;
    },
    toastClasses() {
      return [this.toastType, this.getPosition];
    },
    toastTitle() {
      return this.title
        ? this.title
        : this.type.charAt(0).toUpperCase() + this.type.slice(1);
    },
  },
  components: {
    IconError,
    IconWarning,
    IconSuccess,
  },
};
</script>

<style scoped>
.toast {
  width: 400px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  box-shadow: 1px 5px 10px -5px rgba(0, 0, 0, 0.2);
  position: relative;
}
.toast::before {
  content: "";
  width: 4px;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
}
.toast-icon {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  padding: 7px;
}
.toast-success .toast-icon svg {
  fill: #ecfdf5;
}
.toast-success {
  background: #ecfdf5;
}
.toast-success::before,
.toast-success .toast-icon {
  background: #34d399;
}
.toast-warning .toast-icon svg {
  fill: #fffbeb;
}
.toast-warning {
  background: #fffbeb;
}
.toast-warning::before,
.toast-warning .toast-icon {
  background: #f59e0b;
}
.toast-error .toast-icon svg {
  fill: #f3f2f2;
}
.toast-error {
  background: #fef2f2;
}
.toast-error::before,
.toast-error .toast-icon {
  background: #ef4444;
}
.toast-content {
  flex-grow: 1;
  margin: 0 1rem;
}
.toast-title {
  font-weight: 700;
  margin-bottom: 0.5rem;
}
.toast-message {
  font-size: 14px;
  color: #6b7280;
}
.toast-button {
  width: 1.5em;
  height: 1.5em;
  border: none;
  padding: 0;
  color: #9ca3af;
  opacity: 0.7;
  background: transparent;
  cursor: pointer;
  font-size: 1.5em;
}
.toast-button:hover {
  opacity: 1;
}
.bottom-left {
  position: fixed;
  left: 2rem;
  bottom: 2rem;
}
.top-left {
  position: fixed;
  left: 2rem;
  top: 2rem;
}
.bottom-right {
  position: fixed;
  right: 2rem;
  bottom: 2rem;
}
.top-right {
  position: fixed;
  right: 2rem;
  top: 2rem;
}
.rtl-enter-active,
.rtl-leave-active,
.ltr-enter-active,
.ltr-leave-active {
  transition: all 0.5s ease-in-out;
}
.rtl-enter-from,
.rtl-leave-to {
  transform: translateX(100%);
}
.ltr-enter-from,
.ltr-leave-to {
  transform: translateX(-100%);
}
.rtl-leave-to,
.ltr-leave-to {
  opacity: 0;
}
</style>