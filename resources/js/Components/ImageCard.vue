<template>
	<div class="my-4">
		<a class="block rounded-lg shadow-xl relative" :href="href" :target="target" :rel="rel">
			<Thumbnail
				:src="image"
				:alt="title"
				square
				class="w-auto rounded-lg text-center overflow-hidden absolute inset-0"
			/>
			<div
				class="bg-black bg-opacity-75 text-white rounded-b-lg absolute left-0 right-0 bottom-0 flex flex-col p-4 w-50 justify-between leading-normal break-normal"
			>
				<div class="px-4">
					<p class="font-banner text-xl xl:text-2xl mb-2 break-words">
						{{ title }}
					</p>
					<p class="text-base truncate">{{ snippet }}</p>
					<div class="my-1">
						<div class="text-4xl" v-if="author">
							<p class="font-handwritten leading-none">{{ author.name }}</p>
						</div>
					</div>

					<div>
						<slot></slot>
					</div>
				</div>

				<div>
					<slot name="footer"></slot>
				</div>
			</div>
		</a>
	</div>
</template>

<script>
import Thumbnail from "~/Thumbnail";
import Card from "~/Card";

export default {
	extends: Card,
	components: {
		Thumbnail,
	},
};
</script>