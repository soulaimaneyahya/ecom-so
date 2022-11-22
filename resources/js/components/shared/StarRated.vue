<template>
<div class="d-flex" role="button">
    <i
    class="fas fa-star"
    v-for="star in fullStars"
    :key="'full' + star"
    @click="$emit('rating:changed', star)"
    ></i>
    <i class="fas fa-star-half-alt" v-if="halfStar"></i>
    <i
    class="far fa-star"
    v-for="star in emptyStars"
    :key="'empty' + star"
    @click="$emit('rating:changed', fullStars + star)"
    ></i>
</div>
</template>


<script>
export default {
props: ['rating'],
computed: {
    fullStars() {
        // 4.3 = 4 and half
        // > 4.5 = 5 stars
        return Math.round(this.rating);
    },
    halfStar() {
        const fraction = Math.round((this.rating - Math.floor(this.rating)) * 100);
        // console.log(fraction);
        return fraction > 0 && fraction < 50;
    },
    emptyStars() {
        // if rating would be 1.9, ceil(1.9) = 2, 5 - 2 = 3, render 3 empty stars - 2 full stars
        // if rating would be 1.3, ceil(1.3) = 2, 5 - 2 = 3, render 3 empty stars - 1 full star and half => 1.5
        return 5 - Math.ceil(this.rating);
    }
}
}
</script>

<style></style>
