<?php
declare(strict_types=1);
namespace App\Application\Actions\sender;





use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\Sql;


abstract class SenderAction extends Action
{

    public function __construct(LoggerInterface $logger, Sql $sql)
    {
        parent::__construct($logger,$sql);
    }
}
