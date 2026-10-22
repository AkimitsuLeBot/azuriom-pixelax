<?php

return [
    'nav' => [
        'title' => '상점',
        'settings' => '설정',
        'packages' => '패키지',
        'gateways' => '게이트웨이',
        'offers' => '제안',
        'coupons' => '쿠폰',
        'giftcards' => '기프트 카드',
        'discounts' => '할인',
        'payments' => '결제',
        'subscriptions' => 'Subscriptions',
        'variables' => 'Variables',
        'purchases' => '구매',
        'statistics' => '통계',
    ],

    'permissions' => [
        'settings' => 'Manage shop settings',
        'packages' => 'Manage shop packages and categories',
        'gateways' => 'Manage shop payment gateways',
        'promotions' => 'Manage shop coupons and discounts',
        'giftcards' => 'Manage shop gift cards',
        'payments' => 'Create and view shop payments/purchases and subscriptions',
    ],

    'categories' => [
        'title' => '카테고리',
        'edit' => ':category 카테고리 수정',
        'create' => '카테고리 생성',

        'parent' => '상위 카테고리',
        'delete_error' => '패키지가 포함된 카테고리는 지울 수 없습니다.',

        'cumulate' => '이 카테고리의 누적 구매',
        'cumulate_info' => '이 카테고리에서 이미 패키지를 구매했던 유저의 경우 더 비싼 패키지를 구입할 때 할인을 받고 차액만 지불하게 됩니다.',
        'single_purchase' => 'Limit the user to purchasing a single package from this category',
        'enable' => '카테고리 활성화',
    ],

    'offers' => [
        'title' => '제안',
        'edit' => ':offer 제안 수정',
        'create' => '제안 생성',

        'enable' => '이 제안 활성화',
    ],

    'coupons' => [
        'title' => '쿠폰',
        'edit' => ':coupon 쿠폰 수정',
        'create' => '쿠폰 생성',

        'global' => '쿠폰이 모든 상점에서 사용될 수 있도록 할까요?',
        'cumulate' => '이 쿠폰을 다른 쿠폰과 같이 사용할 수 있게 허용',
        'user_limit' => '유저 제한',
        'global_limit' => '글로벌 제한',
        'active' => '액티브',
        'usage' => 'Under usage limit',
        'enable' => '쿠폰 활성화',
    ],

    'giftcards' => [
        'title' => '기프트 카드',
        'edit' => ':giftcard 기프트 카드 수정',
        'create' => '기프트 카드 생성',

        'global_limit' => '글로벌 제한',
        'active' => '액티브',
        'enable' => '기프트 카드 활성화',
        'link' => 'Shareable link',
        'pending' => 'A payment is pending, the balance might not be updated yet.',
    ],

    'discounts' => [
        'title' => '할인',
        'edit' => ':discount 할인 수정',
        'create' => '할인 생성',

        'global' => '할인이 모든 상점에서 사용될 수 있도록 할까요?',
        'active' => '활성',
        'enable' => '할인 활성화',
        'restricted' => 'Restrict this discount to certain roles only',
    ],

    'packages' => [
        'title' => '패키지',
        'edit' => ':package 패키지 수정',
        'create' => '패키지 생성',

        'every' => 'every',
        'after' => 'after',

        'updated' => '패키지가 업데이트되었습니다.',

        'variables' => 'Custom variables',
        'role' => 'Role to set when the package expires',
        'money' => 'Money to give to the user after purchase',
        'has_giftcard' => 'Create a giftcard after the purchase and give it to the user',
        'giftcard_balance' => 'Giftcard balance',
        'giftcard_fixed' => 'Fixed amount',
        'giftcard_dynamic' => 'Price of the package',
        'command' => 'The command must not start with <code>/</code>. You can use <code>{player}</code> for the player name. For Steam games, you can also use <code>{steam_id}</code> and <code>{steam_id_32}</code>. The others available placeholders are: :placeholders.',
        'has_user_limit' => 'Add an individual purchase limit per user for this package',
        'has_global_limit' => 'Add a global purchase limit for this package',
        'limit_period' => 'Limit period',
        'limits_no_expired' => 'Exclude expired packages when calculating purchase limits',
        'no_period' => 'No period',
        'custom_price' => 'Allow the user to choose the price to pay (the package price will then be the minimum)',
        'enable_quantity' => '수량 활성화',

        'billing' => 'Billing type',
        'billing_period' => 'Billing period',
        'one_off' => 'One-off payment',
        'subscription' => 'Subscription with automatic renewal',
        'subscription_info' => 'Make sure your payment gateway supports subscriptions. When a subscription is created, the user will be charged the same price until the subscription is canceled (any discount active during the first payment will be applied to the next payments).',
        'expiring' => 'One-off payment with expiration',
        'expiring_info' => 'The product will be automatically removed after the specified period.',
        'scheduler' => 'You must set up CRON tasks to use subscriptions, see the <a href="https://azuriom.com/docs/faq" target="_blank" rel="noopener norefferer">FAQ</a> for more information.',

        'create_category' => '카테고리 생성',
        'create_package' => '패키지 생성',

        'enable' => '페키지 활성화',
    ],

    'commands' => [
        'online' => 'Wait for the player to be online before executing the command (requires AzLink)',
        'offline' => 'Execute the command directly, whether the player is online or not',
        'servers' => 'You need to add at least one server to create a command.',

        'trigger' => 'Command trigger',
        'command' => 'Command',
        'condition' => 'Condition to execute the command',

        'triggers' => [
            'purchase' => 'Initial Purchase',
            'expiration' => 'After Expiration',
            'refund' => 'Payment Refunded',
            'chargeback' => 'Chargeback',
            'renewal' => 'Subscription Renewal',
        ],
    ],

    'gateways' => [
        'title' => '게이트웨이',
        'edit' => ':gateway 게이트웨이 수정',
        'create' => '게이트웨이 추가',

        'current' => '현재 게이트웨이',
        'add' => '새 게이트웨이 추가',
        'info' => '만약 Cloudflare 또는 방화벽을 사용중인 상태에서 구매에 문제가 있다면, <a href="https://azuriom.com/docs/faq" target="_blank" rel="noopener norefferer">FAQ</a>의 절차를 따라해보세요.',

        'country' => '국가',
        'sandbox' => '샌드박스',
        'api-key' => 'API 키',
        'public-key' => '공개 키',
        'private-key' => '개인 키',
        'secret-key' => '비밀 키',
        'endpoint-secret' => 'Signing Secret',
        'service-id' => '서비스 ID',
        'client-id' => '클라이언트 ID',
        'merchant-id' => '가맹점 ID',
        'project-id' => '프로젝트 ID',
        'webhook_id' => 'Webhook ID',
        'website_id' => 'Website ID',
        'env' => '환경',

        'subscription' => 'This payment gateway supports automatic subscription renewal.',
        'no_subscription' => 'This payment gateway does not support automatic subscription renewal.',

        'paypal_email' => 'PayPal 이메일 주소',
        'paypal_info' => 'Please make sure to input the <strong>primary</strong> email address of the PayPal account.',
        'paypal_checkout' => 'On the PayPal dashboard, in your API application, create a webhook with URL <code>:url</code> and select the events <code>:events</code>.',
        'stripe_info' => 'On the Stripe dashboard you need to set the webhook URL to <code>:url</code> and select the events: <code>:events</code>.',
        'paymentwall_info' => 'PaymentWall 대시보드에서 핑백 주소를 <code>:url</code>로 설정해야 합니다.',
        'xsolla' => 'Xsola 대시보드에서 웹훅 주소를 <code>:url</code>로 설정하고, \'Paystation\' 설정에서 \'Transaction external ID\'를 활성화하고, 웹훅을 테스트한 다음, \'PayStation\' 설정에서 \'Checkout\'을 활성화해야 합니다.',
        'skrill_email' => 'Skrill Email Address',
        'skrill_secret' => 'Secret Word',
        'skrill_info' => 'The website ID and the Secret Word can be found in the Skrill dashboard under "Developer Settings".',

        'enable' => '게이트웨이 활성화',
    ],

    'payments' => [
        'title' => '결제',
        'show' => '#:payment 결제',

        'info' => '결제 정보',
        'items' => '구매한 아이템',

        'card' => '상점 결제',

        'status' => [
            'pending' => '대기중',
            'expired' => '만료됨',
            'chargeback' => '지불거절',
            'completed' => '완료됨',
            'refunded' => '환불됨',
            'error' => '오류',
        ],
    ],

    'purchases' => [
        'title' => '구매',
    ],

    'subscriptions' => [
        'title' => 'Subscriptions',
        'show' => 'Subscription #:subscription',

        'info' => 'Subscription information',
        'error' => 'To continue, you must cancel associated subscriptions and wait for their expiration.',

        'status' => [
            'active' => 'Active',
            'canceled' => 'Canceled',
            'expired' => 'Expired',
        ],
    ],

    'settings' => [
        'title' => '상점 설정',
        'enable_home' => '상점의 홈페이지 활성화',
        'home_message' => '홈 메시지',
        'use_site_money' => '사이트 화폐로 구매 활성화.',
        'use_site_money_info' => '활성화되면, 상점에 있는 패키지는 웹사이트의 돈으로만 구매할 수 있습니다. 유저가 계정에 재화를 넣기 위해 상점에 제안을 설정할 수 있습니다.',
        'webhook' => '디스코드 웹훅 주소',
        'webhook_info' => '유저가 구매할 때 웹훅으로 알림이 갑니다. 빈칸으로 두면 비활성화됩니다.',
        'commands' => '글로벌 명령어',
        'recent_payments' => '사이드바에 표시될 최근 구매 표시 갯수를 제한 (0으로 설정해 비활성화)',
        'display_amount' => 'Display amount spend in recent payments and top customer',
        'top_customer' => '월별 최고 고객을 사이드바에 표시',

        'terms_required' => 'Require users to accept terms of service before purchase',
        'terms' => 'Terms of service',
        'terms_info' => 'Links in Markdown format, for example: <code>I accept the [terms of service](https://example.com/terms) of the shop.</code>',
    ],

    'variables' => [
        'title' => 'Variables',
        'edit' => 'Edit variable :variable',
        'create' => 'Create variable',

        'info' => 'Variables are custom fields that can be added to packages. They can be used to ask for additional information from the user when purchasing a package.',

        'name' => 'The internal name of the variable, cannot be changed after creation.',
        'required' => 'Should this variable be required?',
        'options' => 'Options',

        'text' => 'Text',
        'number' => 'Number',
        'email' => 'E-Mail',
        'checkbox' => 'Checkbox',
        'dropdown' => 'Dropdown',
    ],

    'logs' => [
        'shop-gateways' => [
            'created' => '#:id 게이트웨이 생성됨',
            'updated' => '#:id 게이트웨이 업데이트됨',
            'deleted' => '#:id 게이트웨이 삭제됨',
        ],

        'shop-packages' => [
            'created' => '#:id 패키지 생성됨',
            'updated' => '#:id 패키지 업데이트됨',
            'deleted' => '#:id 패키지 삭제됨',
        ],

        'shop-offers' => [
            'created' => '#:id 제안 생성됨',
            'updated' => '#:id 제안 업데이트됨',
            'deleted' => '#:id 제안 삭제됨',
        ],

        'shop-giftcards' => [
            'used' => 'Used giftcard #:id (:amount)',
        ],
    ],

    'statistics' => [
        'title' => '통계',
        'total' => '총합',
        'recent' => '최근 결재',
        'count' => '결제 횟수',
        'estimated' => '예상 수입',
        'month' => '이번달의 결제',
        'month_estimated' => '이번달의 예상 수입',
    ],

];
