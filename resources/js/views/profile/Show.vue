<template>
    <b-api :url="profileUrl" v-slot:default="{data:profile}">
        <div class="container mx-auto mt-8">

            <p class="text-gray-500 m-1">
                created
                <date :date="profile.created_at"></date>
                ,
                updated
                <date :date="profile.updated_at"></date>
            </p>

            <div class="mb-3 clearfix">
                <h1 class="font-bold text-4xl float-left" v-text="profile.name"></h1>
                <router-link :to="{name: 'profiles.edit', params: {profile: profile.id}}"
                             class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-3 ml-3 py-1 px-4 rounded focus:outline-none focus:shadow-outline float-left"
                >Edit
                </router-link>
            </div>


            <div class="mb-3">
                <p class="w-full text-gray-600"
                   v-text="profile.description ? profile.description: 'No description'"
                ></p>
            </div>


            <div class="flex mb-3">
                <div class="w-full">
                    <div class="rounded border-2 w-full">
                        <p class="m-3" v-text="profile.content ? profile.content : 'No content'"></p>
                    </div>
                </div>

            </div>

        </div>

    </b-api>
</template>

<script>
    export default {
        computed: {
            profileUrl()
            {
                return `/api/profiles/${ this.$route.params.profile }`;
            },
        },
        methods: {},
    };
</script>
