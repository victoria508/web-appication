<template>
    <div class="container mx-auto mt-8">
        <h1 class="font-bold text-4xl mb-2">Edit profile</h1>

        <b-api :url="profileUrl">
            <template v-slot:loading>
                <div>Loading</div>
            </template>

            <template v-slot:default="{data}">
                <b-form :action="profileUrl"
                        method="patch"
                        :form-data="data"
                        @submitted="submitted"
                        @keydown="errors.clear($event.target.name)"
                        v-slot:default="{data, errors}"
                >
                    <div class="flex flex-wrap -mx-3 mb-3">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="profile-form-name"
                            >
                                Name
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                   id="profile-form-name"
                                   type="text"
                                   placeholder="Name"
                                   v-model="data.name"
                            >
                            <p class="text-red-500 text-xs italic" v-if="errors.has('name')"
                               v-text="errors.get('name')"
                            ></p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-3">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="profile-form-description"
                            >
                                Description
                            </label>
                            <textarea
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="profile-form-description"
                                type="text"
                                placeholder="Description"
                                v-model="data.description"
                            ></textarea>
                            <p class="text-red-500 text-xs italic" v-if="errors.has('description')"
                               v-text="errors.get('description')"
                            ></p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-3">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="profile-form-content"
                            >
                                Content
                            </label>
                            <textarea
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="profile-form-content"
                                type="text"
                                rows="10"
                                placeholder="Content"
                                v-model="data.content"
                            ></textarea>
                            <p class="text-red-500 text-xs italic" v-if="errors.has('content')"
                               v-text="errors.get('content')"
                            ></p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="submit"
                            >
                                Create
                            </button>
                            <a href="#"
                               class="bg-gray-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block focus:outline-none focus:shadow-outline"
                               @click.prevent="cancel"
                            >
                                Cancel
                            </a>
                        </div>
                    </div>
                </b-form>
            </template>

        </b-api>
    </div>
</template>

<script>
    export default {
        computed: {
            profileUrl()
            {
                return `/api/profiles/${ this.$route.params.profile }`;
            },
        },
        methods: {
            submitted()
            {
                this.$router.push({name: 'profiles.show', params: {profile: this.$route.params.profile}});
            },

            cancel()
            {
                if (confirm('Are you sure?'))
                {
                    this.$router.back();
                }
            },
        },
    };
</script>
