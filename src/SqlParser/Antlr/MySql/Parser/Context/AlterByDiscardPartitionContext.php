<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Seata\SqlParser\Antlr\MySql\Parser\Context;

    use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
    use Antlr\Antlr4\Runtime\Tree\TerminalNode;
    use Hyperf\Seata\SqlParser\Antlr\MySql\Listener\MySqlParserListener;
    use Hyperf\Seata\SqlParser\Antlr\MySql\Parser\MySqlParser;

    class AlterByDiscardPartitionContext extends AlterSpecificationContext
    {
        public function __construct(AlterSpecificationContext $context)
        {
            parent::__construct($context);

            $this->copyFrom($context);
        }

        public function DISCARD(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::DISCARD, 0);
        }

        public function PARTITION(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::PARTITION, 0);
        }

        public function TABLESPACE(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::TABLESPACE, 0);
        }

        public function uidList(): ?UidListContext
        {
            return $this->getTypedRuleContext(UidListContext::class, 0);
        }

        public function ALL(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::ALL, 0);
        }

        public function enterRule(ParseTreeListener $listener): void
        {
            if ($listener instanceof MySqlParserListener) {
                $listener->enterAlterByDiscardPartition($this);
            }
        }

        public function exitRule(ParseTreeListener $listener): void
        {
            if ($listener instanceof MySqlParserListener) {
                $listener->exitAlterByDiscardPartition($this);
            }
        }
    }
