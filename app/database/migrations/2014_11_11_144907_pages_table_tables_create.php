<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagesTableTablesCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table)
        {
            $table->increments('id');
            $table->string('title');
            $table->longText('body');
            $table->timestamps();
        });

		Schema::create('blocks', function($table)
        {
            $table->increments('id');
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
        });

        DB::table('pages')->insert(
            array(
                array(
                    'title' => 'faq'
                ),
                array(
                    'title' => 'howdoipay'
                ),
                array(
                    'title' => 'bestinvestment'
                ),
                array(
                    'title' => 'info'
                ),
                array(
                    'title' => 'news'
                ),
                array(
                    'title' => 'promotions'
                ),
            )
        );

		DB::table('blocks')->insert(
            array(
                array(
                    'title' => 'main-block',
                    'content' => '{"title":"Our business is the best deal for you!",
		"body":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Morbi ex ex, ornare nec elit a, varius convallis metus. Suspendisse potenti.",
		"video_1":"qLJ3fERSS1Q",
		"video_2":"qLJ3fERSS1Q",
		"video_3":"qLJ3fERSS1Q"}',
                ),
                array(
                    'title' => 'block-1',
                    'content' => '{"title":"title",
		"body":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit.", 
		"link":"#"}',
                ),
                array(
                    'title' => 'block-2',
                    'content' => '{"title":"title",
		"body":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit.", 
		"link":"#"}',
                ),
                array(
                    'title' => 'block-3',
                    'content' => '{"title":"title",
		"body":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit.", 
		"link":"#"}',
                ),
                array(
                    'title' => 'partners',
                    'content' => '{"partner_1":"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",
	"partner_2":"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",
	"partner_3":"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",
	"partner_4":"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",
	"partner_5":"iVBORw0KGgoAAAANSUhEUgAAASQAAAB9CAYAAAALDx5nAAAACXBIWXMAABcSAAAXEgFnn9JSAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABiZJREFUeNrs3f1zDHccB/DVEUNIKmc0RlHPtIJBGfygfzS/lxmjplqZEipt0SGMQ5NIGg9hRu+zYzd7cRd33CVbeb1+2iTf23znZvY93+ddcfbcubcJwNK78IXvACgLgQQIJACBBAgkAIEECCQAgQQIJACBBAgkAIEECCQAgQQIJACBBAgkAIEEIJAAgQQgkACBBCCQAIEEIJAAgQQgkACBBCCQAIEEIJAAgQQgkACBBCCQAAQSIJAABBIgkAAEEiCQAAQSIJAABBIgkAAEErBMrPQV/D9sGBhITp0+nV7PzMwkP54/70tBCwlAIAECCUAgAQIJYKmYZSMVs3h9fX3J0MGDdb+fnX2d/DF6Kxkfn0im/p1u+X49K1cmX2/enGzc+FUyuGmw5c+1MoPY6boikCiJNatXJ0MHhpqGxqpVPfmDf//+/eTmzZvJ6zdvFrznYC2Ejp843nZdxicmkodjY4taVwQSJdG/ri85eepU+iC3YuvWrUmlUkkuX76cvHj5smGZaBUdOXIk/3nk+vXkwcOHeTBEqOzYviPZuWtnXZm/791b9LoikCiJ6FId+/5Y3QM+ems0qVardd2d6B5tqT3c8YCHtWvXJkeOHk0uXbrU8J4Hai2YzJWfryTVJ4/rykQ43Lz1e/L8+Uzemtm7b/+CgdSNulJOBrWXqT2796QPbOan2kP75+2/3ht7+afWjfrt2rVkeHg4/12l9uBv37atYesoC43oMs0Po6IIoBgvyrpa0c1bzLoikChR62jLu1ZE1mWKh3kh0e2Kcplo1czX2zsXGs8mJz9Yj+qjan69Zs3qRa0rAomSqAxU8pZMzEx9aPym+KBH+Watmp5Cl6pTg8ndqisCiZLo7+/Pr8dqXatWRchUq48a3if9+7sAyFo27WgWYN2qKwKJkli/fn1+HYPL7Sh2xXrX9tb9rXivLwv/o2k9KgP59fj4+KLWFYFESazrW/fRXati+VU9q+r+Vn08N4gdM10xVd9MdKFiwDn93KNq06n5btUVgcRnLkKlOJh85ocz6QxXsfsW13t27c4XTsY4z8iNEV8eKeuQlqFXs7N10+idFIPOPbXWyL79+9KfY63R/C0eeTdtYiIZuXZ9wYWL3awrAokSeP1qtq7F0o5i+dnXsw3LxBqhkIXSfHdu30meTT1LZ8KWuq4IJJbY5ORkvh8sHXxucSo9L//O85nnDct8t//bdGtIdMd+/eXKB9cNLWVdKRdjSMvQ1NRUfj04uKnllkeUi/KN7pOJ7RvZPrUbN0Y+KYy6XVcEEiUQWzqKiwZjy0crtn+zvW6RYqOtIZXKhvy62VR+WeqKQKIk4tygTAw6bxgYWLB8BEFxTKj4+Wb27t3b9rjPUtWVcjCGtEzFbNjmLVvytUDxiqUYbI7VzcVu1vwd9CE2xTbbwjH2YCwPg63zPtdIKwPc3aor5bPi7Llzb30N5Vd8L1u7mp3CGGcTnTx5sq1p9bjXh84YiroeOny4rfvGEoDhq1eb3rdbdaVULuiyLWPxoF68eDE9KqQVsaI6yjd7wKN7FjNsEZztrh2K1k+cXbRYdUWXjRKK7RVxhtDdO3eTSmUgPaqjeBBadk719PT0gjNmEUbHT5zIu1XRpRobG1vwbOtoScVMWDYrF5+NLSXNBqA7VVd02fjMZWuPQpzmmC2O7PZn0WWD91pHWaBEK6XdQIlB7fxePT2+0GVMIPHJ+vvmdvVPdGDtEQIJOuJj9owV1yq1e+YRAgnqTE3PDVzHq4faDaMdO+deiVQ8UwmBBG1Lj4t9d2B/TPe3+paPWFsUM3PZEoEY0DZNv7yZ9qcjRkdHk4FKJX97bOy0f/r0acMV2OmhbYUzk9KWUS3QzK5h2p+OiSNrhw4dzNcitSJm5eJUgFbORuKzd0ELiY6JRZDxlthY3BjvWZu/cLHYGnry5HHy4sVLu/DRZaO7spCxqZV2GdQGBBKAQAIEEoBAAgQSgEACBBKAQAIEEoBAAgQSgEACBBKAQAIEEoBAAhBIgEACEEiAQAIQSIBAAhBIgEACEEiAQAIQSIBAAhBIgEACEEiAQAIQSAACCRBIAAIJEEgAAgkQSAACCfhM/CfAAMNfyq8iogTXAAAAAElFTkSuQmCC",
	"partner_6":"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"}',
                ),
            )
        );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('pages');
	}

}
