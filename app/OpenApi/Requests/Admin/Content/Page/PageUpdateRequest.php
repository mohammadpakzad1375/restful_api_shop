<?php

namespace App\OpenApi\Requests\Admin\Content\Page;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PageUpdateRequest",
    properties: [
        new OA\Property(
            property: "title",
            type: "string",
            example: "راهنمای جامع هوش مصنوعی در توسعه نرم‌افزار"
        ),
        new OA\Property(
            property: "body",
            type: "string",
            example: "در این صفحه به بررسی کاربردهای هوش مصنوعی در توسعه نرم‌افزار، مزایا، چالش‌ها و ابزارهای پرکاربرد پرداخته شده است. همچنین نمونه‌هایی از استفاده عملی آن در پروژه‌های واقعی ارائه می‌شود."
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "هوش مصنوعی-برنامه نویسی-لاراول-توسعه نرم افزار"
        ),
        new OA\Property(
            property: "status",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ]
)]
class PageUpdateRequest
{

}
