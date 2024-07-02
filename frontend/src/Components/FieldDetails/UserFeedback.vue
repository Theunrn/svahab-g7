<template>
    <div class="contaner">
        <div class="head"><h1> Customers' feedback</h1></div>
        <div><span id="comment">1</span> Comment</div>
        <div class="comment">
            <div class="comment-item">
                <img src="../../assets/ShopImage/cat.jpg" alt="">
                <div class="comment-content">
                    <h3>Anonymous</h3>
                    <p>This field is so good.</p>
                </div>
            </div>
        </div>
        <div class="commentbox">
            <img src="../../assets/ShopImage/cat.jpg" alt="">
            <div class="content">
                <div class="commentinput">
                    <input type="text" placeholder="Enter comment" class="usercomment">
                    <div class="buttons">
                        <button type="submit" disabled id="publish">Publish</button>
                        <div class="notify">
                            <input type="checkbox" class="notifyinput"><span>Notify me</span>
                        </div>
                    </div>
                </div>
                <p class="policy">Your feedback is very important for us to improve more and make it more better.</p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

</script>

<style scoped>
.contaner {
    color: #000;
    margin: 0 auto;
    padding: 20px;
    border-radius: 8px;
    margin-left: 50px;
}

.head {
    text-transform: uppercase;
    margin-bottom: 20px;
}
h1{
    font-size: 1.5em;
    font-weight: 700;
}
.text {
    margin: 10px 0;
    font-family: sans-serif;
    font-size: 0.9em;
}

.comment {
    margin-bottom: 20px;
}

.comment-item {
    display: flex;
    align-items: flex-start;
    padding: 10px;
    border-bottom: 1px solid #ccc;
    margin-bottom: 10px;
}

.comment-item img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 20px;
    object-fit: cover;
    object-position: center;
}

.comment-content {
    width: 100%;
}

.comment-content h3 {
    font-size: 16px;
    margin: 0;
    margin-bottom: 5px;
}

.comment-content p {
    margin: 0;
    color: #555;
}

.commentbox {
    display: flex;
    align-items: flex-start;
    padding: 10px;
}

.commentbox img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 20px;
    object-fit: cover;
    object-position: center;
}

.content {
    width: 100%;
}

.user {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    color: #808080;
}

.commentinput {
    display: flex;
    flex-direction: column;
}

.usercomment {
    width: 100%;
    padding: 10px;
    border: none;
    border-bottom: 2px solid blue;
    outline: none;
}

.buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #808080;
    margin-top: 10px;
}

.buttons button {
    padding: 8px 16px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 4px;
    cursor: pointer;
}

.buttons button:disabled {
    background-color: #ccc;
}

.notify {
    display: flex;
    align-items: center;
    margin-left: 10px;
}

.notifyinput {
    margin-right: 5px;
}

.policy {
    margin: 20px 0;
    font-size: 0.8em;
    font-family: Arial, Helvetica, sans-serif;
    color: #808080;
}

.policy a {
    text-decoration: none;
    color: blue;
}
</style>
