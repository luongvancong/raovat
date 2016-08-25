
<div class="list-group post-sidebar">
	@foreach($categories as $pCat)
	<a href="{{ route('post.category', [$pCat->getId(), $pCat->getSlug()]) }}" class="list-group-item {{ isset($category) && $category->getSlug() == $pCat->getSlug() ? 'active' : '' }}">
		<h3 class="title">{{ $pCat->getName() }}</h3>
	</a>
	@endforeach
</div>