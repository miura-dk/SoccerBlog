<template>
<v-app>

  <header>
    <v-app-bar
      app
      class="cyan"
      dark
    >
      <v-app-bar-nav-icon
        @click="drawer = true"
      >
      </v-app-bar-nav-icon>
      <v-toolbar-title>
        <a href="/" class="white--text">
              <v-icon class="mr-1">
                mdi-soccer
              </v-icon>Soccer-Blog
        </a>
      </v-toolbar-title>
      <div class="ml-auto"></div>
      <ul
      class="cyan"
      dark
      style="display:flex; justify-content:end; align-items:center"
      >
            <li class="ml-4"
              v-if="authorized == false">
              <a class="white--text" :href="urlRegister">ユーザー登録</a>
            </li>
          
            <li class="ml-4"
              v-if="authorized == false">
              <a class="white--text" :href="urlLoginForm">ログイン</a>
            </li>
          
            <li class="ml-4"
              v-if="authorized == true">
              <a class="white--text" :href="urlArticlesCreate">
                <v-icon class="mr-1">mdi-pencil</v-icon>
                <span>投稿する</span>
              </a>
            </li>
      </ul>

      <v-menu
        left
        bottom
        v-if="authorized == true"
      >
        <template v-slot:activator="{ on }">
          <v-btn icon v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list
        nav
        dense
        class="cyan darken-4"
        dark
        >
          <v-list-item-group>
            <div
              @click="() => {}"
            >
              <v-list-item>
                <v-list-item-title>マイページ</v-list-item-title>
              </v-list-item>
              
              <v-list-item>
                <v-list-item-title><button form="logout-button-2" type="submit">ログアウト</button></v-list-item-title>
              </v-list-item>
              
            </div>
          </v-list-item-group>
        </v-list>
        
        <form id="logout-button-2" method="POST" :action="urlLogout">
          <input type="hidden" name="_token" :value="csrf">
        </form>
      </v-menu>
    </v-app-bar>
    <v-navigation-drawer
    v-model="drawer"
    fixed
    temporary
    class="cyan darken-4"
    dark
    >
      <v-list
      nav
      dense>
        <v-list-item-group>
          <v-list-item>
            <v-list-item-title><a class="white--text" href="/">HOME</a></v-list-item-title>
          </v-list-item>
          <v-list-item
            v-show="authorized == false"
            :href="urlRegister"
          >
            <v-list-item-title><a class="white--text">ユーザー登録</a></v-list-item-title>
          </v-list-item>
          <v-list-item
            v-show="authorized == false"
            :href="urlLoginForm"
          >
            <v-list-item-title>ログイン</v-list-item-title>
          </v-list-item>
          <v-list-item
            v-show="authorized == true"
          >
            <v-list-item-title>マイページ</v-list-item-title>
          </v-list-item>
          <v-list-item
            v-show="authorized == true"
          >
            <v-list-item-title>お気に入り</v-list-item-title>
          </v-list-item>
          <v-list-item
            v-show="authorized == true"
          >
            <v-list-item-title><button form="logout-button-1" type="submit">ログアウト</button></v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
      <form id="logout-button-1" method="POST" :action="urlLogout">
          <input type="hidden" name="_token" :value="csrf">
      </form>
    </v-navigation-drawer>

  </header>
  
<v-content>
  <v-alert 
    type="success" 
    v-if="flashSuccessMessage !== ''"
  >
    flashSuccessMessage
  </v-alert>
  <v-alert type="error"
    v-if="flashErrorMessage !== ''">
      error message
  </v-alert>
  
  <v-container 
  fluid
  >

    <v-row
    align="center"
    justify="center">
      <v-col
      cols="12"
      sm="8"
      md="4"
      v-for="article in articles" 
      :key="article.id"
      >
        <v-card
        class="mx-auto"
        max-width="400"
        color="#3F51B5"
        dark
        v-for="(name,index) in initialUsernames"
        :key="index"
        >
          <v-img
            class="white--text align-end"
            height="200px"
            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
          >
          </v-img>

          <v-card-title>
            <a href="" style="text-decoration: none; color:white;">{{article['title']}}</a>
            <div class="ml-auto"></div>
            <v-menu
              left
              bottom
            >
              <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                  <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
              </template>

              <v-list
              nav
              dense
              class="cyan darken-4"
              dark
              >
                <v-list-item-group>
                  <div
                    @click="() => {}"
                  >
                    <v-list-item>
                      <v-list-item-title><v-icon class="mr-2">mdi-file-edit-outline</v-icon>記事を更新する</v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title style="color:pink;"><v-icon class="mr-2 red">mdi-trash-can-outline</v-icon>記事を削除する</v-list-item-title>
                    </v-list-item>
                  </div>
                </v-list-item-group>
              </v-list>
            </v-menu>
          </v-card-title>

          <v-card-text>
            <v-icon class="mr-2">
                  mdi-account-circle
            </v-icon>
            名前：{{ name }}
          </v-card-text>

          <v-card-text>

            <div>本文：{{article['content']}}</div>

            <div>
              <a
                class="grey--text text--lighten-2" 
                href=""
              >
                続きを読む
                <v-icon class="ml-1">
                  mdi-chevron-double-right
                </v-icon>
              </a>
            </div>
            

            <div>
              <v-icon class="mr-2">
                mdi-clock
              </v-icon>
              作成日：{{article['created_at']}}
              <v-icon class="ml-4 mr-1">
                mdi-star
              </v-icon>
              5
            </div>

          </v-card-text>

          <v-card-actions>
            
            <v-btn
              color="#E91E63"
            >
              <v-icon class="mr-1">
                mdi-star-outline
              </v-icon>
              お気に入り追加
            </v-btn>

            <v-btn
              color="#00BCD4"
            >
              <v-icon class="mr-1">
                mdi-account-plus-outline
              </v-icon>
              フォローする
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

  </v-container>
</v-content>

</v-app>
</template>

<script>
  export default {
    data(){
        return {
          dateResult:'',
          drawer: false,
          authorized: this.authorized,
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          
        }
    },
    props:{
        articles:{
          type: Array,
          required: true,
        },
        urlRegister:{
          type: String,
        },
        authorized:{
          type: Boolean,
          default: false,
        },
        urlLoginForm:{
          type: String,
        },
        urlLogout:{
          type: String,
        },
        urlArticlesCreate:{
          type: String,
        },
        initialUsernames:{
          type: Array,
        },
        flashSuccessMessage:{
          type: String,
          dafault: '',
        },
        flashErrorMessage:{
          type: String,
          dafault: '',
        }
    },
    methods: {
      // timestampから指定したdate形式(Y/m/d H:i:s)に変換
      changeTimestampToFormat(date){
        //let timestamp = 1318518000;
        let d = new Date(date*1000);
        let year = d.getFullYear();
        let month = d.getMonth() + 1;
        let day = d.getDate();
        let hour = (d.getHours()<10) ? '0'+d.getHours() : (d.getHours());
        let min = (d.getMinutes()<10) ? '0'+d.getMinutes() : (d.getMinites());
        let sec = (d.getSeconds()<10) ? '0'+d.getSeconds() : (d.getSeconds());

        this.dateResult = year+'-'+month+'-'+day+' '+hour+':'+min+':'+sec;
        return this.dateResult;
      }
    },
    computed:{
      
    },
  }
</script>

<style>
a{
  text-decoration:none;
  
}
li{
  list-style-type: none;
}

</style>