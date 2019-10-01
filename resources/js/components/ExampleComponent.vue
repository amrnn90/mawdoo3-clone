<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example componentt.
                    </div>
                    <div v-for="link in links" :key="link">
                        <a :href="link">{{link}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            setTimeout(() => {
                this.links.push('/category/2')
            }, 3000);
        },
        data: () => ({
            links: []
        })
    }
</script>
