<template>
    <div :class="classObject">
      <star-rated class="fa-lg" :rating="review.rating" @rating:changed="onRatingChanged"></star-rated>
      <input type="hidden" v-model="review.rating" name="rating" />
    </div>
</template>

<script>
export default {
  props: ['reviewRating', 'errorRating'],
  data() {
    return {
      review: {
        rating: this.reviewRating,
      },
      dFlex: true,
      formControl: true,
    }
  },
  computed: {
    classObject(){
      return {
        'd-flex': this.dFlex,
        'form-control': this.formControl,
        'is-invalid': this.errorRating,
      }
    }
  },
  methods: {
    onRatingChanged(star) {
      this.review.rating = Number(star)
      // console.log(star)
    }
  },
};
</script>
