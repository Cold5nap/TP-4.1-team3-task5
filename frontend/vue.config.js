const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  transpileDependencies: true,
  pages: {
    user: {
      // entry for the *public* page
      entry: "src/pages/user/main.js",
      // the source template
      template: "src/pages/user/index.html",
      // output as dist/index.html
      filename: "userIndex.html",
    },
    admin: {
      // entry for the *public* page
      entry: "src/pages/admin/main.js",
      // the source template
      template: "src/pages/admin/index.html",
      // output as dist/index.html
      filename: "adminIndex.html",
    },
  },
});
