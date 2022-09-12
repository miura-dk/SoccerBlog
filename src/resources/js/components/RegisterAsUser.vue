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
                        <v-toolbar-title>ユーザー登録</v-toolbar-title>
                        <v-spacer />
                    </v-toolbar>

                    <v-form
                      @submit.prevent
                      :ref="urlRegister"
                    >
                        <v-card-text>
                            <v-text-field
                              label="名前"
                              name="name"
                              prepend-icon="mdi-account-circle"
                              type="text"
                              v-model="name"
                            />
                            <small>2〜100文字(登録後の変更はできません)</small>
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
                            <v-text-field
                              label="パスワード(確認)"
                              name="password_confirmation"
                              prepend-icon="mdi-lock"
                              type="password"
                              v-model="password_confirmation"
                            />
                        
                        </v-card-text>

                        <v-card-actions
                          class="justify-center"
                        >
                            <v-btn
                              @click="submit"
                              color="primary"
                            >
                                ユーザー登録
                            </v-btn>
                            
                        </v-card-actions>
                    </v-form>
                    <div
                      class="mt-2 mb-4"
                      style="display:flex; justify-content: center;"
                    >
                        <a href="" class="blue--text">ログインはこちら</a>
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
        urlRegister:{
            type: String,
        },

    },
    data(){
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            showPassword : false,
        }
    },
    methods: {
        postRegister(){
            axios.post(window.location.origin + `/register`,{
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(response => {
                window.location.href = `/`;
            })
            .catch(error =>{
                console.log("エラーが発生しました。");
            });
        },

        submitData(){
            console.log(this.name,this.email,this.password,this.password_confirmation)
        },
    },

}
</script>

<style>

</style>