<template>
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 col-lg-12 pt-5">
                <form
                    action=""
                    method="post"
                    class="pt-5"
                    @submit.prevent="senData"
                >
                    <div class="form-group d-flex col-md-12">
                        <input
                            class="form-control"
                            type="url"
                            v-model="url"
                            placeholder="Enter URL"
                            @submit.prevent="senData()"
                        />
                        <button class="btn btn-success col-md-2 col-lg-2">
                            Generate Short Link
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-12 col-lg-12 pt-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ShortLink</th>
                            <th scope="col">Url</th>
                            <th scope="col">Nb visit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="link in links" :key="link.id">
                            <th scope="row">{{ link.id }}</th>
                            <td>
                                <a :href="link.url" @click="count_click">
                                    {{ link.shorturl }}</a
                                >
                            </td>
                            <td>{{ link.url }}</td>
                            <td>{{ link.nb_visit }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            url: "",
            links: [],
            counter: "",
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        senData() {
            axios
                .post("http://127.0.0.1:8000/api/generate_shortlink", {
                    url: this.url,
                })
                .then((rep) => {
                    console.log(rep.data);
                })
                .catch((error) => {
                    console.log(error.data);
                });
        },
        getData() {
            axios
                .get("http://127.0.0.1:8000/api/get_links_data")
                .then((rep) => {
                    // console.log(rep.data);
                    this.links = rep.data;
                })
                .catch((error) => {
                    console.log(error.data);
                });
        },
        count_click() {
            axios
                .post("http://127.0.0.1:8000/api/generate_shortlink", {
                    url: this.url,
                })
                .then((rep) => {
                    console.log(rep.data);
                })
                .catch((error) => {
                    console.log(error.data);
                });
        },
    },
};
</script>
<style>
body {
    background-color: rgb(242, 223, 209);
}
</style>
