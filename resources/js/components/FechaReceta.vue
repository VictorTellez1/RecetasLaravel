
<template>
    <span v-text="formatearFecha"></span>
</template>

<script>
    export default{
        props:['fecha'],
        computed:{
            formatearFecha(){
                return moment(this.fecha).locate('es').format('DD [de] MMMM [del] YYYY')
            }
        }
    }


</script>
