<template>
  <v-app>
    <v-container
      class="fill-height"
      fluid
    >
        <v-row
          align="center"
          justify="center"
        >
            <v-col
              cols="12"
              sm="10"
              md="8"
            >
                <div class="mb-2">
                    <h1 style="text-align:center;"><a href="/" style="color:#009688;">Soccer-Blog</a></h1>
                </div>
                <v-card
                  class="mx-auto"
                  max-width="800"
                >
                    <v-toolbar
                      color="primary"
                      dark
                      flat
                      style="display:flex; justify-content:center;"
                    >
                      <v-toolbar-title>ログイン</v-toolbar-title>
                      <v-spacer />
                    </v-toolbar>

                    <form
                      method="POST"
                      :action="urlLogin"
                      id="login"
                    >
                      <input type="hidden" name="_token" :value="csrf">
                        <v-card-text>
                            <v-text-field
                              label="メールアドレス"
                              name="email"
                              prepend-icon="mdi-email"
                              type="email"
                              v-model="email"
                            />
                            <v-text-field
                              label="パスワード"
                              name="password"
                              prepend-icon="mdi-lock"
                              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                              :type="showPassword ? 'text' : 'password'"
                              @click:append="showPassword = !showPassword"
                              v-model="password"
                              hint="英数字8文字以上"
                            />
                        </v-card-text>

                        <v-card-actions
                          class="justify-center"
                        >
                            <v-btn
                              type="submit"
                              color="primary"
                              form="login"
                            >
                              ログイン
                            </v-btn>
                            
                        </v-card-actions>
                    </form>
                    <div
                      class="mt-2 mb-4"
                      style="display:flex; justify-content: center;"
                    >
                      <a :href="urlRegister" class="blue--text p-2">ユーザー登録はこちら</a>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
  </v-app>
</template>

<script>
export default {
    props:{
      urlLogin:{
        type: String,
      },
      urlRegister:{
        type: String,
      },
    },
    data(){
        return {
            email: "",
            password: "",
            showPassword : false,

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    methods: {
      
    },

}
</script>

<style>

</style>