<template>
	<div class="comments-area white-box">
        <h4>{{ $blogDetails->comments_count}} Comments</h4>
        <list-comment  v-bind:allComment="{{ $blogComment }}"></list-comment>
    </div>
    <add-comment v-bind:blog="{{ $blogDetails }}"></add-comment>
</template>