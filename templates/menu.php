<?php if (isset($user) && $user): ?>
<a href="/?act=articles">
    <button type="button" class="btn btn-success add-article">Articles</button>
</a>
<a href="/?act=add">
    <button type="button" class="btn btn-success add-article">Add new article</button>
</a>
<a href="/?act=profile">
    <button type="button" class="btn btn-secondary add-article">Profile</button>
</a>
<a href="/?act=logout">
    <button type="button" class="btn btn-dark add-article">Logout</button>
</a>
<?php endif ?>
