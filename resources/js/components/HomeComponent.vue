<template>
    <div class="container">
        <div class="row justify-content-center py-5">
            <div
                v-if="alert"
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ msg_alert }}
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
            </div>

            <div class="col-md-12 col-lg-12 pt-2">
                <form
                    action=""
                    method="post"
                    class="pt-5"
                    @submit.prevent="senData"
                >
                    <div class="form-group d-flex col-md-12">
                        <input
                            id="input_url"
                            class="form-control py-3"
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
                            <th scope="col">Total clicks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="link in links" :key="link.id">
                            <th scope="row">{{ link.id }}</th>
                            <td>
                                <a
                                    :href="link.url"
                                    @click="
                                        count_click(link.id, link.nb_visit + 1)
                                    "
                                    target="_blank"
                                >
                                    {{ link.shorturl }}</a
                                >
                            </td>
                            <td>{{ link.url }}</td>
                            <td>{{ link.nb_visit }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 pt-3">
                <div class="row">
                    <h4 class="col-lg-12">Most visited URLs:</h4>
                    <ol class="col-lg-12 pb-3 list-group list-group-flush">
                        <li
                            class="ms-5 list-group-item"
                            v-for="(m_link, index) in most_links"
                            :key="m_link.id"
                        >
                            <div class="row">
                                <div class="col-lg-9">
                                    <b class="fs-6">{{ index + 1 }} - </b>
                                    {{ m_link.url }}
                                </div>
                                <div class="col-lg-3 text-end">
                                    <span
                                        class="badge bg-success rounded-pill"
                                        >{{ m_link.nb_visit }}</span
                                    >
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
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
            counter: 0,
            alert: false,
            msg_alert: "",
            most_links: [],
        };
    },
    mounted() {
        this.getData();
        this.get_most_links();
    },
    methods: {
        senData() {
            axios
                .post("http://127.0.0.1:8000/api/generate_shortlink", {
                    url: this.url,
                })
                .then((rep) => {
                    console.log(rep.data);
                    this.alert = true;
                    this.msg_alert = rep.data;
                    this.url = "";
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
        count_click(id, nbclick) {
            axios
                .post("http://127.0.0.1:8000/api/nbvisit", {
                    id: id,
                    nb_visit: nbclick,
                })
                .then((rep) => {
                    location.reload;
                    // console.log(rep.data);
                })
                .catch((error) => {
                    console.log(error.data);
                });
        },
        get_most_links() {
            axios
                .get("http://127.0.0.1:8000/api/get_most_links")
                .then((rep) => {
                    this.most_links = rep.data;
                    console.log(error.data);
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
    background-color: rgb(232, 246, 248);
}
</style>
