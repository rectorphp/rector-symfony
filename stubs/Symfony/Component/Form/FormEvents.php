<?php

declare(strict_types=1);

namespace Symfony\Component\Form;

if (class_exists('Symfony\Component\Form\FormEvents')) {
    return;
}

final class FormEvents
{
    public const PRE_SUBMIT = 'form.pre_submit';

    public const SUBMIT = 'form.submit';

    public const POST_SUBMIT = 'form.post_submit';

    public const PRE_SET_DATA = 'form.pre_set_data';

    public const POST_SET_DATA = 'form.post_set_data';
}
