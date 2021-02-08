<template>
    <div class="container mx-auto mt-8">

        <!--        Notification-->

        <div class="mb-3 clearfix">
            <h1 class="font-bold text-4xl float-left">Profiles</h1>
            <router-link :to="{name: 'profiles.create'}"
                         class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-3 ml-3 py-1 px-4 rounded focus:outline-none focus:shadow-outline float-left"
            >New profile
            </router-link>
        </div>

        <b-api url="/api/profiles" v-slot:default="{data: profiles}">
            <div class="flex flex-wrap">
                <div v-if="!profiles.length">No profiles</div>

                <div class="w-1/3 mb-3" v-else v-for="profile in profiles">
                    <div class="border-2 rounded mr-3">
                        <router-link :to="{name:'profiles.show', params:{profile: profile.id}}"
                                     class="inline-block text-2xl text-blue-700 font-bold mx-3 my-2"
                        >{{ profile.name }}
                        </router-link>

                        <div class="m-3 mt-0">
                            <p v-text="profile.description"></p>
                        </div>

                        <div class="m-3 mt-0">
                            <p class="text-gray-600">created
                                <date :date="profile.created_at"></date>
                            </p>
                            <p class="text-gray-600">updated
                                <date :date="profile.updated_at"></date>
                            </p>
                        </div>
                        <div class="bg-gray-100 border-t px-3 py-2">
                            <router-link :to="{name: 'profiles.edit', params: {profile: profile.id}}"
                                         class="text-blue-600"
                            >Edit
                            </router-link>
                            <button class="text-red-700 ml-1" @click="deleteProfile(profile)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </b-api>

    </div>
</template>

<script>
    import brainr from '../apis/brainr';

    export default {
        methods: {
            deleteProfile(profile)
            {
                if (confirm(`Are you sure you want to delete the profile '${ profile.name }'?`))
                {
                    brainr.delete(`/api/profiles/${ profile.id }`).
                        then(() => this.loadProfiles());
                }
            },
        },
    };
</script>
