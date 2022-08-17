<template>
    <v-app>
        <v-main>
            <v-container>Hello world</v-container>
                <v-row>
                    <v-col cols="6">
                        <v-btn color="indigo darken-1">ボタン1</v-btn>
                    </v-col>
                    <v-col cols="6">
                        <v-btn color="red">ボタン2</v-btn>
                    </v-col>
                </v-row>
            
        </v-main>
    </v-app>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
