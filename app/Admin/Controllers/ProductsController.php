<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('查看')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑商品')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('创建商品')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->id('ID')->sortable();
        $grid->title('商品名称');
        $grid->on_sale('已上架')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->edible('食品')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->daily_use('生活用品')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->wash_rinse('个性美妆')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->price('价格');
        $grid->rating('评分');
        $grid->sold_count('销量');
        $grid->review_count('评论数');
        $grid->created_at('创建时间');
        $grid->updated_at('最后一次更改时间');

        $grid->quickSearch('title');

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('on_sale','已上架')->radio([
                0    => '否',
                1    => '是',
            ]);
            $filter->equal('edible','食品酒水')->radio([
                0    => '否',
                1    => '是',
            ]);
            $filter->equal('daily_use','生活用品')->radio([
                0    => '否',
                1    => '是',
            ]);
            $filter->equal('wash_rinse','个性美妆')->radio([
                0    => '否',
                1    => '是',
            ]);

        });


        $grid->actions(function ($actions) {
            //$actions->disableView();
            $actions->disableDelete();
        });

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Product::findOrFail($id));

        $show->id('ID');
        $show->title('商品标题');
        $show->description('详情');
        $show->image('图片');
        $show->on_sale('是否上架');
        $show->rating('评分');
        $show->sold_count('销量');
        $show->review_count('评论数');
        $show->price('价格');
        $show->created_at('创建时间');
        $show->updated_at('更改时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->text('title', '商品名称')->rules('required');
        $form->editor('description', '商品详情')->rules('required');
        $form->image('image', '图片')->rules('required|image');
        $form->radio('on_sale', '上架')->options(['1' => '是', '0'=> '否'])->default('0');
        $form->radio('edible', '食品酒水')->options(['1' => '是', '0'=> '否'])->default('0');
        $form->radio('daily_use', '生活用品')->options(['1' => '是', '0'=> '否'])->default('0');
        $form->radio('wash_rinse', '美妆个护')->options(['1' => '是', '0'=> '否'])->default('0');
        $form->hasMany('skus', 'SKU 列表', function (Form\NestedForm $form) {
            $form->text('title', 'SKU 名称')->rules('required');
            $form->text('description', 'SKU 描述')->rules('required');
            $form->text('price', '单价')->rules('required|numeric|min:0.01');
            $form->text('stock', '剩余库存')->rules('required|integer|min:0');
        });
        //在编辑页面隐藏查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        // 定义事件回调，当模型即将保存时会触发这个回调
        $form->saving(function (Form $form) {
            //collect() 函数是 Laravel 提供的一个辅助函数，可以快速创建一个 Collection 对象。
            //在这里我们把用户提交上来的 SKU 数据放到 Collection 中，
            //利用 Collection 提供的 min() 方法求出所有 SKU 中最小的 price，
            //后面的 ?: 0 则是保证当 SKU 数据为空时 price 字段被赋值 0。
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
        });

        return $form;
    }
}
