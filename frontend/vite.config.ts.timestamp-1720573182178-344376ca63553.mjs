// vite.config.ts
import { fileURLToPath, URL } from "node:url";
import { defineConfig } from "file:///C:/Users/VORLEAK.KUN/Desktop/g7-svahab-app/frontend/node_modules/vite/dist/node/index.js";
import vue from "file:///C:/Users/VORLEAK.KUN/Desktop/g7-svahab-app/frontend/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import vueJsx from "file:///C:/Users/VORLEAK.KUN/Desktop/g7-svahab-app/frontend/node_modules/@vitejs/plugin-vue-jsx/dist/index.mjs";
import VueDevTools from "file:///C:/Users/VORLEAK.KUN/Desktop/g7-svahab-app/frontend/node_modules/vite-plugin-vue-devtools/dist/vite.mjs";
import Unocss from "file:///C:/Users/VORLEAK.KUN/Desktop/g7-svahab-app/frontend/node_modules/unocss/dist/vite.mjs";
import { presetAttributify, presetUno } from "file:///C:/Users/VORLEAK.KUN/Desktop/g7-svahab-app/frontend/node_modules/unocss/dist/index.mjs";
var __vite_injected_original_import_meta_url = "file:///C:/Users/VORLEAK.KUN/Desktop/g7-svahab-app/frontend/vite.config.ts";
var vite_config_default = defineConfig({
  plugins: [
    vue(),
    vueJsx(),
    VueDevTools(),
    Unocss({
      presets: [presetAttributify(), presetUno()]
    })
  ],
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", __vite_injected_original_import_meta_url))
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcudHMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxWT1JMRUFLLktVTlxcXFxEZXNrdG9wXFxcXGc3LXN2YWhhYi1hcHBcXFxcZnJvbnRlbmRcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkM6XFxcXFVzZXJzXFxcXFZPUkxFQUsuS1VOXFxcXERlc2t0b3BcXFxcZzctc3ZhaGFiLWFwcFxcXFxmcm9udGVuZFxcXFx2aXRlLmNvbmZpZy50c1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vQzovVXNlcnMvVk9STEVBSy5LVU4vRGVza3RvcC9nNy1zdmFoYWItYXBwL2Zyb250ZW5kL3ZpdGUuY29uZmlnLnRzXCI7aW1wb3J0IHsgZmlsZVVSTFRvUGF0aCwgVVJMIH0gZnJvbSAnbm9kZTp1cmwnXHJcblxyXG5pbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tICd2aXRlJ1xyXG5pbXBvcnQgdnVlIGZyb20gJ0B2aXRlanMvcGx1Z2luLXZ1ZSdcclxuaW1wb3J0IHZ1ZUpzeCBmcm9tICdAdml0ZWpzL3BsdWdpbi12dWUtanN4J1xyXG5pbXBvcnQgVnVlRGV2VG9vbHMgZnJvbSAndml0ZS1wbHVnaW4tdnVlLWRldnRvb2xzJ1xyXG5pbXBvcnQgVW5vY3NzIGZyb20gJ3Vub2Nzcy92aXRlJ1xyXG5pbXBvcnQgeyBwcmVzZXRBdHRyaWJ1dGlmeSwgcHJlc2V0VW5vIH0gZnJvbSAndW5vY3NzJyAvLyBQcmVzZXRzXHJcblxyXG4vLyBodHRwczovL3ZpdGVqcy5kZXYvY29uZmlnL1xyXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xyXG4gIHBsdWdpbnM6IFtcclxuICAgIHZ1ZSgpLFxyXG4gICAgdnVlSnN4KCksXHJcbiAgICBWdWVEZXZUb29scygpLFxyXG4gICAgVW5vY3NzKHtcclxuICAgICAgcHJlc2V0czogW3ByZXNldEF0dHJpYnV0aWZ5KCksIHByZXNldFVubygpXVxyXG4gICAgfSlcclxuICBdLFxyXG4gIHJlc29sdmU6IHtcclxuICAgIGFsaWFzOiB7XHJcbiAgICAgICdAJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3NyYycsIGltcG9ydC5tZXRhLnVybCkpXHJcbiAgICB9XHJcbiAgfVxyXG59KVxyXG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQXVWLFNBQVMsZUFBZSxXQUFXO0FBRTFYLFNBQVMsb0JBQW9CO0FBQzdCLE9BQU8sU0FBUztBQUNoQixPQUFPLFlBQVk7QUFDbkIsT0FBTyxpQkFBaUI7QUFDeEIsT0FBTyxZQUFZO0FBQ25CLFNBQVMsbUJBQW1CLGlCQUFpQjtBQVA0SyxJQUFNLDJDQUEyQztBQVUxUSxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUMxQixTQUFTO0FBQUEsSUFDUCxJQUFJO0FBQUEsSUFDSixPQUFPO0FBQUEsSUFDUCxZQUFZO0FBQUEsSUFDWixPQUFPO0FBQUEsTUFDTCxTQUFTLENBQUMsa0JBQWtCLEdBQUcsVUFBVSxDQUFDO0FBQUEsSUFDNUMsQ0FBQztBQUFBLEVBQ0g7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNQLE9BQU87QUFBQSxNQUNMLEtBQUssY0FBYyxJQUFJLElBQUksU0FBUyx3Q0FBZSxDQUFDO0FBQUEsSUFDdEQ7QUFBQSxFQUNGO0FBQ0YsQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
