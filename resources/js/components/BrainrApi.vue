<script>
    import brainr from '../apis/brainr';

    export default {
        props: {
            url: {
                type: String,
                required: true,
            },
        },
        data()
        {
            return {
                loaded: false,
                response: null,
                error: null,
            };
        },
        mounted()
        {
            brainr.get(this.url).
                then(response => this.response = response).
                catch(e => this.error = e).
                finally(() => this.loaded = true);
        },
        render()
        {
            if (this.loaded)
            {
                return this.$scopedSlots.default({
                    data: this.response.data,
                });
            }

            return this.$slots.loading ? this.$slots.loading[0] : null;
        },
    };
</script>
