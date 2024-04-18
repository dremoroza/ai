<template>
<div class="flex flex-col items-center justify-center w-screen min-h-screen bg-gray-100 text-gray-800 p-10">

<!-- Component Start -->
<div class="chat flex flex-col flex-grow w-full max-w-xl bg-white shadow-xl rounded-lg overflow-hidden">
    <div id="chatWrap" class="flex flex-col h-0 flex-grow p-4 overflow-auto"> 
        <div v-for="(item, index) in chat_history"
          :id="item.id"
          :key="item.id">
          
            <div  v-if="item.role == 'assistant'" class="flex w-full mt-2 space-x-3 max-w-xs">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300">
                    <img src="/images/avatar-vc.png" class="rounded-full">
                </div>
                <div>
                    <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                        <div class="text-sm" v-html="item.content"></div>
                    </div>
                </div>
            </div>
            <div v-if="item.role == 'user'" class="flex w-full mt-2 space-x-3 max-w-xs ml-auto justify-end">
                <div>
                    <div class="bg-blue-600 text-white p-3 rounded-l-lg rounded-br-lg">
                        <div class="text-sm" v-html="item.content"></div>
                    </div>
                </div>
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300"></div>
            </div>
        </div>
        <div  v-if="submitting" id="typing" class="flex w-full mt-2 space-x-3 max-w-xs">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300">
                    <img src="/images/avatar-vc.png" class="rounded-full">
                </div>
                <div>
                   <img src="/images/loader.svg" class="h-[45px]">
                </div>
        </div>
        <div id="end" class="mb-4">&nbsp;</div>



    </div>
    
    <div class="bg-gray-300 p-4 flex flex-row space-x-2">
        <input class="flex items-center h-10  rounded px-3 text-sm w-3/4" type="text" placeholder="Type your message…" v-model="chat" v-on:keyup.enter="submitBtn">
        <button class="btn bg-blue-600 p-2 text-white rounded-xl w-1/4" v-on:click="submitBtn">Send</button>

    </div>
</div>
<!-- Component End  -->

</div>
</template>

<script>
import axios from 'axios'

    export default {
        data() {
            return {
                chat: null,
                uid: localStorage.getItem("uid"),
                agency_uid: '813d0f8b-4137-4313-92a1-38a55758e1ab',
                client_uid: '32705b3f-fa26-4f35-900c-da165a9020b3',
                content: '',
                chat_history: [],
                submitting: false,
            }
        },
        methods: {
            submitBtn () {
            
                if(this.submitting){
                    return false;
                }

                if(this.chat){
                    this.submitting = true;
                    axios.post('api/chat', {
                        uid: this.uid, 
                        content: this.chat,
                        agency_uid: this.agency_uid,
                        client_uid: this.client_uid,
                    }).then((response) => {

                        if(response.data.status){
                            localStorage.setItem("uid", response.data.uid);
                            this.uid = response.data.uid;
                            this.chat_history = response.data.chat_history;
                            this.submitting = false;
                        }

                        this.chat = null;
                        this.scrollToElement('chatWrap');
                        

                    }).catch((error) => { 
                        this.submitting = false;
                    });  
                }
  
            },
            getChatHistory(){
                axios.get('api/chat/' + localStorage.getItem("uid")).then((response) => {
                    if(response.data.status){
                        this.chat_history = response.data.chat_history
                        setTimeout(() => {
                        var elmnt = document.getElementById("end");
                            elmnt.scrollIntoView();
                        })
                    }
                })
            },
            scrollToElement() {
                var ref = document.getElementById('end');
                    setTimeout(function () {
                        ref.scrollIntoView({
                            behavior: "smooth",
                            block: "start",
                        });
                    }, 100);
            },
        },
        mounted() {
            if(localStorage.getItem("uid")){
                this.getChatHistory();    
            }
        }
    }
</script>