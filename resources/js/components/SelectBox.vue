<template>
    <select v-model="selected" @change="selectedOption">
        <option
            :key="option.id"
            v-for="option in options"
            :value="option.id"
            :selected="option.id == selected"
        >
            {{ option.text }}
        </option>
    </select>
</template>

<script>
export default {
    name: "SelectBox",
    props: {
        options: Array,
        currentOption: null,
    },
    data() {
        return {
            selected: String,
        };
    },
    methods: {
        selectedOption: function () {
            console.log(this.selected);
            this.$emit("current-option", this.selected);
        },
    },
    emits: ["current-option"],
    mounted() {
        this.selected = this.currentOption;
    },
};
</script>

<style scoped>
select {
    margin: auto 10px;
    padding: 6px 12px;
    width: 120px;
    max-width: 120px;
    border-radius: 25px;
    box-shadow: 1px 1px #888888;
}
</style>
