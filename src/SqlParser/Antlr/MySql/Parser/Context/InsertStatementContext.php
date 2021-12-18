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

use Antlr\Antlr4\Runtime\ParserRuleContext;
    use Antlr\Antlr4\Runtime\Token;
    use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
    use Antlr\Antlr4\Runtime\Tree\TerminalNode;
    use Hyperf\Seata\SqlParser\Antlr\MySql\Listener\MySqlParserListener;
    use Hyperf\Seata\SqlParser\Antlr\MySql\Parser\MySqlParser;

    class InsertStatementContext extends ParserRuleContext
    {
        /**
         * @var null|Token
         */
        public $priority;

        /**
         * @var null|UidListContext
         */
        public $partitions;

        /**
         * @var null|UidListContext
         */
        public $columns;

        /**
         * @var null|UpdatedElementContext
         */
        public $setFirst;

        /**
         * @var null|UpdatedElementContext
         */
        public $updatedElement;

        /**
         * @var null|UpdatedElementContext
         */
        public $duplicatedFirst;

        /**
         * @var null|array<UpdatedElementContext>
         */
        public $setElements;

        /**
         * @var null|array<UpdatedElementContext>
         */
        public $duplicatedElements;

        public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
        {
            parent::__construct($parent, $invokingState);
        }

        public function getRuleIndex(): int
        {
            return MySqlParser::RULE_insertStatement;
        }

        public function INSERT(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::INSERT, 0);
        }

        public function tableName(): ?TableNameContext
        {
            return $this->getTypedRuleContext(TableNameContext::class, 0);
        }

        public function insertStatementValue(): ?InsertStatementValueContext
        {
            return $this->getTypedRuleContext(InsertStatementValueContext::class, 0);
        }

        public function SET(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::SET, 0);
        }

        public function IGNORE(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::IGNORE, 0);
        }

        public function INTO(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::INTO, 0);
        }

        public function PARTITION(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::PARTITION, 0);
        }

        /**
         * @return null|array<TerminalNode>|TerminalNode
         */
        public function LR_BRACKET(?int $index = null)
        {
            if ($index === null) {
                return $this->getTokens(MySqlParser::LR_BRACKET);
            }

            return $this->getToken(MySqlParser::LR_BRACKET, $index);
        }

        /**
         * @return null|array<TerminalNode>|TerminalNode
         */
        public function RR_BRACKET(?int $index = null)
        {
            if ($index === null) {
                return $this->getTokens(MySqlParser::RR_BRACKET);
            }

            return $this->getToken(MySqlParser::RR_BRACKET, $index);
        }

        /**
         * @return null|array<UpdatedElementContext>|UpdatedElementContext
         */
        public function updatedElement(?int $index = null)
        {
            if ($index === null) {
                return $this->getTypedRuleContexts(UpdatedElementContext::class);
            }

            return $this->getTypedRuleContext(UpdatedElementContext::class, $index);
        }

        public function ON(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::ON, 0);
        }

        public function DUPLICATE(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::DUPLICATE, 0);
        }

        public function KEY(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::KEY, 0);
        }

        public function UPDATE(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::UPDATE, 0);
        }

        public function LOW_PRIORITY(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::LOW_PRIORITY, 0);
        }

        public function DELAYED(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::DELAYED, 0);
        }

        public function HIGH_PRIORITY(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::HIGH_PRIORITY, 0);
        }

        /**
         * @return null|array<TerminalNode>|TerminalNode
         */
        public function COMMA(?int $index = null)
        {
            if ($index === null) {
                return $this->getTokens(MySqlParser::COMMA);
            }

            return $this->getToken(MySqlParser::COMMA, $index);
        }

        /**
         * @return null|array<UidListContext>|UidListContext
         */
        public function uidList(?int $index = null)
        {
            if ($index === null) {
                return $this->getTypedRuleContexts(UidListContext::class);
            }

            return $this->getTypedRuleContext(UidListContext::class, $index);
        }

        public function enterRule(ParseTreeListener $listener): void
        {
            if ($listener instanceof MySqlParserListener) {
                $listener->enterInsertStatement($this);
            }
        }

        public function exitRule(ParseTreeListener $listener): void
        {
            if ($listener instanceof MySqlParserListener) {
                $listener->exitInsertStatement($this);
            }
        }
    }