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
      >
        <v-card
        class="mx-auto"
        max-width="400"
        color="#3F51B5"
        dark
        >
          <v-img
            class="white--text align-end"
            height="200px"
            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
          >
          </v-img>

          <v-card-title>
            <a :href="urlArticlesShow" style="text-decoration: none; color:white;">{{article['title']}}</a>
            <div class="ml-auto"></div>
            <v-menu
              left
              bottom
              v-show="article.matched == true"
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
                    <v-list-item
                      @click="editArticle(article.id)">
                      <v-list-item-title><v-icon class="mr-2">mdi-file-edit-outline</v-icon>記事を更新する</v-list-item-title>
                    </v-list-item>
                    <v-list-item
                      @click.stop="dialog = true"
                      @click="getArticleTitle(article)"
                    >
                      <v-list-item-title style="color:pink;"><v-icon class="mr-2 red">mdi-trash-can-outline</v-icon>記事を削除する</v-list-item-title>
                    </v-list-item>
                  </div>
                </v-list-item-group>
              </v-list>
            </v-menu>

                <v-dialog
                  v-model="dialog"
                  persistent
                >
                    <form id="delete" method="POST" :action="articleDeleteUrl">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="_method" value="DELETE">
                        <v-card>
                          <v-card-text>{{ articleTitle }}を削除します。よろしいですか？</v-card-text>
                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn @click="dialog = false">
                            キャンセル
                            </v-btn>

                            <v-btn
                              class="pink"
                              @click="makeDeleteUrl(article.id)"
                              type="submit"
                              form="delete">
                            削除する
                            </v-btn>
                            <v-spacer></v-spacer>
                          </v-card-actions>
                        </v-card>
                    </form>
                </v-dialog>
            
          </v-card-title>

          <v-row>
            <v-col>
              <v-icon class="ml-4 mr-1">
                mdi-star
              </v-icon>
              3
            </v-col>
          </v-row>

          <v-card-text>
            <v-icon class="mr-2">
                  mdi-account-circle
            </v-icon>
            {{ article['user_name'] }}

            <v-btn
              color="#00BCD4"
              class="ml-auto"
            >
              <v-icon class="mr-1">
                mdi-account-plus-outline
              </v-icon>
              フォローする
            </v-btn>
          </v-card-text>

          <v-card-text>
            <div>{{article['content']}}</div>

            <div>
              <v-icon class="mr-2">
                mdi-clock
              </v-icon>
              作成日：{{article['created_date']}}
              
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
          drawer: false,
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          articleTitle: '',
          deleteArticleId: '',
          dialog: false,
          articleDeleteUrl: '',
        }
    },
    props:{
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
        article:{
          type: Array,
        },
        urlArticlesShow:{
          type: String,
        }
    },
    methods: {
      editArticle(id){
        //ここに編集ボタンを押したときに対象の記事のid(article.id)を取得してそれをURL{article}部分に組み込む処理をつくる。例として@click="editArticle(article.id)"
        let url = location.href; //このページのURLをstring型で取得
        let urlArticlesEdit = ''; //初期化
        urlArticlesEdit = url +'articles/'+ id + '/edit';
        console.log(urlArticlesEdit);

        // this.articles.forEach(article =>{
        //   if(article.id == id){
        //     const articleData = article;
        //   }
        // });
        // this.$emit('child-event',articleData);

        // 編集ページへ遷移する
        location.href = urlArticlesEdit;
      },

      // 削除記事のobjectから記事のタイトル,idを見つける(クリックで呼び出す)
      getArticleTitle(obj){
        this.articleTitle = obj.title;
        this.deleteArticleId = obj.id;
      },

      // 削除するボタンを押したとき、記事のidを取得し、URLを生成
      makeDeleteUrl(id){
        let url = location.href; //このページのURLをstring型で取得
        let urlArticlesDelete = ''; //初期化
        urlArticlesDelete = url +'articles/'+ id;

        this.articleDeleteUrl = urlArticlesDelete;
      },
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