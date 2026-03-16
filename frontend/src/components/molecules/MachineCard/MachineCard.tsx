import type { Machine } from '../../../types/machine';
import StateBadge from '../../atoms/StateBadge/StateBadge';
import styles from './MachineCard.module.css';

function MachineCard({ name, state }: Machine) {
  return (
    <div className={styles.card}>
      <span className={styles.name}>{name}</span>
      <StateBadge state={state} />
    </div>
  );
}

export default MachineCard;
