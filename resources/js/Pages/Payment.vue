<template>
    <div style="text-align:center;height: 50vh; margin-top: 100px">
        <div class="checkmark-circle">
            <div class="background"></div>
            <div class="checkmark draw"></div>
        </div>
        <h1>THANK YOU!</h1>
        <p>You are all set. Well done!</p>
        <Link class="btn btn-outline-success" href="/">Continue</Link>
    </div>
</template>

<script>
import Layout from "../frontend/Layout.vue";
export default {
    name: "Payment",
    props:{
        siteSettings:Object,
        authUser:Object,
    },
    layout: Layout
}
</script>
<style scoped>
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

@keyframes confetti-slow {
    0% {
        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
    }

    100% {
        transform: translate3d(25px, 105vh, 0) rotateX(360deg) rotateY(180deg);
    }
}

@keyframes confetti-medium {
    0% {
        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
    }

    100% {
        transform: translate3d(100px, 105vh, 0) rotateX(100deg) rotateY(360deg);
    }
}

@keyframes confetti-fast {
    0% {
        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
    }

    100% {
        transform: translate3d(-50px, 105vh, 0) rotateX(10deg) rotateY(250deg);
    }
}

.container {
    width: 100vw;
    height: 100vh;
    background: #ffffff;
    position: fixed;
    top: 0;
    left: 0;
}

.confetti-container {
    position: absolute;
    overflow: hidden;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.confetti {
    position: absolute;
    z-index: 1;
    top: -10px;
    border-radius: 50%;
}

.confetti--animation-slow {
    animation: confetti-slow 2.25s linear 1 forwards;
}

.confetti--animation-medium {
    animation: confetti-medium 1.75s linear 1 forwards;
}

.confetti--animation-fast {
    animation: confetti-fast 1.25s linear 1 forwards;
}

/* Checkmark */
.checkmark-circle {
    width: 150px;
    height: 150px;
    position: relative;
    display: inline-block;
    vertical-align: top;
    margin-left: auto;
    margin-right: auto;
}

.checkmark-circle .background {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: #00C09D;
    position: absolute;
}

.checkmark-circle .checkmark {
    border-radius: 5px;
}

.checkmark-circle .checkmark.draw:after {
    -webkit-animation-delay: 100ms;
    -moz-animation-delay: 100ms;
    animation-delay: 100ms;
    -webkit-animation-duration: 3s;
    -moz-animation-duration: 3s;
    animation-duration: 3s;
    -webkit-animation-timing-function: ease;
    -moz-animation-timing-function: ease;
    animation-timing-function: ease;
    -webkit-animation-name: checkmark;
    -moz-animation-name: checkmark;
    animation-name: checkmark;
    -webkit-transform: scaleX(-1) rotate(135deg);
    -moz-transform: scaleX(-1) rotate(135deg);
    -ms-transform: scaleX(-1) rotate(135deg);
    -o-transform: scaleX(-1) rotate(135deg);
    transform: scaleX(-1) rotate(135deg);
    -webkit-animation-fill-mode: forwards;
    -moz-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}

.checkmark-circle .checkmark:after {
    opacity: 1;
    height: 75px;
    width: 37.5px;
    -webkit-transform-origin: left top;
    -moz-transform-origin: left top;
    -ms-transform-origin: left top;
    -o-transform-origin: left top;
    transform-origin: left top;
    border-right: 15px solid white;
    border-top: 15px solid white;
    border-radius: 2.5px !important;
    content: '';
    left: 25px;
    top: 75px;
    position: absolute;
}

@-webkit-keyframes checkmark {
    0% {
        height: 0;
        width: 0;
        opacity: 1;
    }

    20% {
        height: 0;
        width: 37.5px;
        opacity: 1;
    }

    40% {
        height: 75px;
        width: 37.5px;
        opacity: 1;
    }

    100% {
        height: 75px;
        width: 37.5px;
        opacity: 1;
    }
}

@-moz-keyframes checkmark {
    0% {
        height: 0;
        width: 0;
        opacity: 1;
    }

    20% {
        height: 0;
        width: 37.5px;
        opacity: 1;
    }

    40% {
        height: 75px;
        width: 37.5px;
        opacity: 1;
    }

    100% {
        height: 75px;
        width: 37.5px;
        opacity: 1;
    }
}

@keyframes checkmark {
    0% {
        height: 0;
        width: 0;
        opacity: 1;
    }

    20% {
        height: 0;
        width: 37.5px;
        opacity: 1;
    }

    40% {
        height: 75px;
        width: 37.5px;
        opacity: 1;
    }

    100% {
        height: 75px;
        width: 37.5px;
        opacity: 1;
    }
}



.submit-btn {
    height: 45px;
    width: 200px;
    font-size: 15px;
    background-color: #00c09d;
    border: 1px solid #00ab8c;
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px 0 rgba(87, 71, 81, .2);
    cursor: pointer;
    transition: all 2s ease-out;
    transition: all .2s ease-out;
}

.submit-btn:hover {
    background-color: #2ca893;
    transition: all .2s ease-out;
}
</style>
