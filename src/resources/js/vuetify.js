import Vue from "vue";
import Vuetify from "vuetify";

Vue.use(Vuetify);

const opts = {
    // mdiを利用する場合
    icons: {
        iconfont: 'mdi',
    },
};
  

export default new Vuetify(opts);