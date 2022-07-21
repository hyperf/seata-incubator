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
namespace Hyperf\Seata\SqlParser\Antlr\MySql\Parser\Context;

use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
use Antlr\Antlr4\Runtime\Tree\TerminalNode;
use Hyperf\Seata\SqlParser\Antlr\MySql\Listener\MySqlParserListener;
use Hyperf\Seata\SqlParser\Antlr\MySql\Parser\MySqlParser;

class TableFlushOptionContext extends FlushOptionContext
{
    public function __construct(FlushOptionContext $context)
    {
        parent::__construct($context);

        $this->copyFrom($context);
    }

    public function TABLES(): ?TerminalNode
    {
        return $this->getToken(MySqlParser::TABLES, 0);
    }

    public function tableNames(): ?TableNamesContext
    {
        return $this->getTypedRuleContext(TableNamesContext::class, 0);
    }

    public function flushTableOption(): ?FlushTableOptionContext
    {
        return $this->getTypedRuleContext(FlushTableOptionContext::class, 0);
    }

    public function enterRule(ParseTreeListener $listener): void
    {
        if ($listener instanceof MySqlParserListener) {
            $listener->enterTableFlushOption($this);
        }
    }

    public function exitRule(ParseTreeListener $listener): void
    {
        if ($listener instanceof MySqlParserListener) {
            $listener->exitTableFlushOption($this);
        }
    }
}
