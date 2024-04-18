<template>
<div class="flex flex-col items-center justify-center w-screen min-h-screen bg-gray-100 text-gray-800 p-10">

<!-- Component Start -->
<div class="flex flex-col flex-grow w-full max-w-xl bg-white shadow-xl rounded-lg overflow-hidden">
    <div class="flex flex-col flex-grow h-0 p-4 overflow-auto">
        <div class="flex w-full mt-2 space-x-3 max-w-xs">
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300">
                <img src="/images/avatar-vc.png" class="rounded-full">
            </div>
            <div>
                <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                    <p class="text-sm">How can i assist you today?</p>
                </div>
                <!-- <span class="text-xs text-gray-500 leading-none">2 min ago</span> -->
            </div>
        </div>
        <div class="flex w-full mt-2 space-x-3 max-w-xs ml-auto justify-end">
            <div>
                <div class="bg-blue-600 text-white p-3 rounded-l-lg rounded-br-lg">
                    <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
                </div>
                <!-- <span class="text-xs text-gray-500 leading-none">2 min ago</span> -->
            </div>
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300"></div>
        </div>
    </div>
    
    <div class="bg-gray-300 p-4 flex flex-row space-x-2">
        <input class="flex items-center h-10  rounded px-3 text-sm w-3/4" type="text" placeholder="Type your message…" v-model="prompt">
        <button class="btn bg-blue-600 p-2 text-white rounded-xl w-1/4" v-on:click="submitBtn()">Send</button>

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
                prompt: '',
                id: 
            }
        },
        methods: {
            submitBtn () {
                if(prompt != ''){
                    axios.post('api/chat', {
                        id: 26, 
                        content: "none",
                        agency_id: 1,
                        client_id: 1
                    }).then((response) => {

                    }).catch((error) => { 

                    });  
                }
  
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
