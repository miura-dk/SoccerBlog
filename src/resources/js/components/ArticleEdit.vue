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
            <li 
              class="ml-4"
              v-if="authorized == true"
            >
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
                <v-list-item-title>
                    <button form="logout-button-2" type="submit">ログアウト</button>
                </v-list-item-title>
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
      dense
      >
        <v-list-item-group>
          <v-list-item>
            <v-list-item-title><a class="white--text" href="/">HOME</a></v-list-item-title>
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
    </v-navigation-drawer>
    <form id="logout-button-1" method="POST" :action="urlLogout">
        <input type="hidden" name="_token" :value="csrf">
    </form>
  </header>

  <v-content>
    <v-container 
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
                <v-card
                  class="mx-auto"
                  max-width="800"
                >
                    <form
                      method="POST"
                      :action="urlArticlesUpdate"
                      id="patch"
                    >
                      <input type="hidden" name="_method" value="PATCH">
                      <input type="hidden" name="_token" :value="csrf">
                        <v-card-text>
                            <v-text-field
                              label="タイトル"
                              name="title"
                              type="text"
                              :value="article.title"
                            />
                            <v-textarea
                              label="本文"
                              name="content"
                              filled
                              auto-grow
                              rows="16"
                              outlined
                              class="mt-5 mb-2"
                              :value="article.content"
                            ></v-textarea>
                        </v-card-text>

                        <v-card-actions
                          class="justify-center mt-2 mb-2"
                        >
                            <v-btn
                              type="submit"
                              color="primary"
                              form="patch"
                            >
                            更新する
                            </v-btn>
                            
                        </v-card-actions>
                    </form>
                </v-card>
            </v-col>
        </v-row>

    </v-container>
  </v-content>

</v-app>
</template>

<script>
export default {
    props:{
        urlLogout:{
            type: String,
        },
        // 記事投稿画面へのGETリクエスト
        urlArticlesCreate:{
            type: String,
        },
        authorized:{
            type: Boolean,
        },
        // 更新処理先URL
        urlArticlesUpdate:{
            type: String,
        },
        article:{
          type: Object,
        }
    },
    data(){
        return {
            drawer: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            title:"",
            content:"",
        }
    },

}
</script>

<style>

</style>