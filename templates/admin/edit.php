<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/header.php'; ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="album py-5 bg-light">
        <div class="container">
            <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="">
                <input type="hidden" name="act" value="edit"/>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h2>Add new article</h2>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group has-danger">
                            <label class="sr-only" for="email">Title</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                <input type="text" name="title" class="form-control" id="email"
                                       placeholder="Title" value="<?=$article['title']?>" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <i class="fa fa-close"></i> Example error message
                        </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group has-danger">
                            <label class="sr-only" for="email">Category</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                <select name="categoryId" class="form-control">
                                    <option value="0">-- category --</option>
                                    <?php while ($row = $stmtCategory->fetch()): ?>
                                        <option value="<?=$row['id']?>" <?php if ($article['categoryId'] == $row['id']): ?>selected<?php endif ?>><?=$row['name']?></option>
                                    <?php endwhile ?>
                                </select>
                               </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <i class="fa fa-close"></i> Example error message
                        </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group has-danger">
                            <label class="sr-only" for="text">Text</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                <textarea name="content" class="form-control" id="text"
                                          placeholder="Text" required autofocus rows="15"><?=$article['content']?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <i class="fa fa-close"></i> Example error message
                        </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group has-danger">
                            <label class="sr-only" for="file">File</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                <input type="file" id="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <i class="fa fa-close"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group has-danger">
                            <label class="sr-only" for="email">Published</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                Published <input type="checkbox" name="isPublished" value="1" <?php if ($article['isPublished']): ?>checked<?php endif ?>/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
                <div class="row" style="padding-top: 1rem">
                    <div class="col-md-6"></div>
                    <div class="col-md-3 text-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/footer.php'; ?>

