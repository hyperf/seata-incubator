<?php

declare(strict_types=1);
/**
 * Copyright 1999-2022 Seata.io Group.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */
namespace Hyperf\Seata\Core\Rpc\Processor\Client;

use Hyperf\Seata\Core\Protocol\RpcMessage;
use Hyperf\Seata\Core\Protocol\Transaction\BranchCommitRequest;
use Hyperf\Seata\Core\Rpc\Processor\AbstractRemotingProcessor;
use Hyperf\Seata\Core\Rpc\RemotingClientInterface;
use Hyperf\Seata\Core\Rpc\TransactionMessageHandler;
use Throwable;

class RmBranchCommitProcessor extends AbstractRemotingProcessor
{
    private TransactionMessageHandler $handler;

    private RemotingClientInterface $remotingClient;

    public function __construct(TransactionMessageHandler $handler, RemotingClientInterface $remotingClient)
    {
        $this->handler = $handler;
        $this->remotingClient = $remotingClient;
    }

    public function process($channel, RpcMessage $rpcMessage)
    {
        /** @var BranchCommitRequest $msg */
        $msg = $rpcMessage->getBody();
        $this->getLogger()->info(sprintf('rm client handle branch commit process: %s', $msg));
        $this->handleBranchCommit($rpcMessage, $channel, $msg);
    }

    private function handleBranchCommit(RpcMessage $rpcMessage, $channel, BranchCommitRequest $branchCommitRequest)
    {
        $resultMessage = $this->handler->onRequest($branchCommitRequest, null);
        $this->getLogger()->debug(sprintf('branch commit result:%s', $resultMessage->getMessage()));
        try {
            $this->remotingClient->sendAsyncResponse($channel, $rpcMessage, $resultMessage);
        } catch (Throwable $exception) {
            $this->getLogger()->debug(sprintf('branch commit error: %s', $exception->getMessage()));
        }
    }
}
