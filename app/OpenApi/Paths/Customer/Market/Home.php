<?php

namespace App\OpenApi\Paths\Customer\Market;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/",
    description: "Returns the data required for the home page.",
    summary: "Customer Home",
    tags: ["Customer/Home"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Home data retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "message",
                        type: "string",
                        example: "Home data retrieved successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(
                                property: "mostViewProducts",
                                type: "array",
                                items: new OA\Items(ref: "#/components/schemas/Product")
                            ),
                            new OA\Property(
                                property: "newestProducts",
                                type: "array",
                                items: new OA\Items(ref: "#/components/schemas/Product")
                            ),
                            new OA\Property(
                                property: "bestSellingProducts",
                                type: "array",
                                items: new OA\Items(ref: "#/components/schemas/Product")
                            ),
                            new OA\Property(
                                property: "mostAmazingSaleProducts",
                                type: "array",
                                items: new OA\Items(ref: "#/components/schemas/Product")
                            ),
                        ],
                        type: "object"
                    )
                ]
            )
        )
    ]
)]
class Home
{

}
