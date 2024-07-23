<template>
    <div class="skill-item text-[50px] font-normal">
        <div class="skill-item-content">
            <i :class="iconClass"></i>
            <p>{{ skillName }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        iconClass: {
            type: String,
            required: true
        },
        skillName: {
            type: String,
            required: true
        }
    },
};
</script>

<style scoped>
.skill-item {
    border: 1px solid black;
    border-radius: 20px;
    font-size: 44px;
    height: 90px;
    width: 90px;
    display: flex;
    align-items: center;
}

.skill-item {
    height: 90px;
    width: 90px;
    position: relative;
    justify-content: center;
}

.skill-item i {
    color: #728afb;
}


.skill-item-content>p {
    display: none;
    position: absolute;
    bottom: -50px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 22px;
    font-weight: bold;
    -webkit-transition: .3s;
    transition: .3s;
    /* text-align: center; */
    margin: 0;
}

.skill-item:hover p {
    display: block;
}

.skill-item:hover p {
    display: block;
}
</style>
