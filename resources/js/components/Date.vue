<template>
    <span v-text="formattedDate"></span>
</template>

<script>
    import {formatRelative} from 'date-fns';

    export default {
        props: ['date'],
        computed: {
            formattedDate()
            {
                try
                {
                    return formatRelative(
                        new Date(this.date),
                        Date.now(),
                    );
                }
                catch (e)
                {
                    return this.date;
                }
            },
        },
    };
</script>
